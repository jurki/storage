<?php

namespace Storage;

class Truck extends Product
{

    public function __construct ($name, $brand, $sku, $price, $power) {
        parent::__construct($name, $brand, $sku, $price);
        $this->power = $power;
    }

    protected $power;

    public function __toString () {
        return parent::__toString() . ' (energiaforrás: ' . $this->power . ")";
    }
}
