<?php

namespace Storage;

class Storage
{
    public static $storages = [];

    public function __construct ($name, $address, $capacity) {
        $this->name = $name;
        $this->address = $address;
        $this->capacity = $capacity;
        self::$storages[] = $this;
    }

    protected $name = '';
    protected $address = '';
    protected $capacity = '';
    protected $stock = [];

    public static function addStock ($product, $quantity) {
        $finish = false;
        foreach (self::$storages as $storage) {
            if (!$finish) {
                $remainingCapacity = $storage->getRemainingCapacity();
                if ($remainingCapacity >= $quantity) {
                    $storage->stock[] = new Stock($product, $quantity);
                    $finish = true;
                } elseif ($remainingCapacity > 0) {
                    $storage->stock[] = new Stock($product, $remainingCapacity);
                    $quantity -= $remainingCapacity;
                }
            }
        }
        if (!$finish) {
            throw new \Exception("Nincs elég hely a raktárakban, úgyhogy " . $quantity . " terméket ki kellett dobni a szemétbe");
        }
    }

    public function getRemainingCapacity () {
        $quantity = 0;
        foreach ($this->stock as $stock) {
            $quantity += $stock->getQuantity();
        }
        if ($quantity > $this->capacity) {
            throw new \Exception("A \"" . $this->name . "\" raktárban túl sok a termék");
        }
        return $this->capacity - $quantity;
    }

    public function getStock ($sku, $quantity) {
        $stockOut = null;
        foreach (self::$storages as &$storage) {
            foreach ($storage->stock as $i => &$stock) {
                if ($stock->getProduct()->getSku() == $sku) {
                    if ($stock->getQuantity() >= $quantity) {
                        if (!$stockOut) $stockOut = new Stock($stock->getProduct(), $quantity);
                        else $stockOut->increaseQuantity($quantity);
                        $stock->decreaseQuantity($quantity);
                        $quantity = 0;
                    } else {
                        if (!$stockOut) $stockOut = new Stock($stock->getProduct(), $stock->getQuantity());
                        else $stockOut->increaseQuantity($stock->getQuantity());
                        $quantity -= $stock->getQuantity();
                        $stock->decreaseQuantity($stock->getQuantity());
                    }
                }

                if ($stock->getQuantity() == 0) unset($storage->stock[$i]);

                if ($quantity == 0) {
                    return $stockOut;
                }
            }
        }
        throw new \Exception("Nem tudtam kiadni " . $quantity . " darab terméket");
    }

    public function __toString () {
        $break = "\n";
        $break = '<br>';
        $r = "Raktár: " . $this->name . $break;
        $r .= "Cím: " . $this->address . $break;
        $r .= "Szabad helyek: " . $this->getRemainingCapacity() . "/" . $this->capacity . $break;
        if (count($this->stock) == 0) {
            $r .= "Készlet: kong az ürességtől" . $break;
        } else {
            $r .= "Készlet:" . $break;
            foreach ($this->stock as $stock) {
                $r .= $stock . $break;
            }
        }
        $r .= $break;
        return $r;
    }

    public static function print () {
        foreach (self::$storages as $storage) {
            echo $storage;
        }
    }
}
