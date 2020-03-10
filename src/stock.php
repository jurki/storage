<?php

namespace Storage;

class Stock
{
    public function __construct ($product, $quantity) {
        $this->product = $product;
        $this->quantity = $quantity;
    }
    protected $product;
    protected $quantity;

    public function getQuantity () {
        return $this->quantity;
    }

    public function increaseQuantity ($quantity) {
        $this->quantity += $quantity;
    }

    public function decreaseQuantity ($quantity) {
        $this->quantity -= $quantity;
    }

    public function getProduct () {
        return $this->product;
    }

    public function __toString () {
        return ' - ' . $this->quantity . " darab " . $this->product;
    }
}
