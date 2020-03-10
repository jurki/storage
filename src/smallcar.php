<?php

namespace Storage;

class SmallCar extends Product
{
    public function __construct($name, $brand, $sku, $price, $color)
    {
        parent::__construct($name, $brand, $sku, $price);
        $this->color = $color;
    }

    protected $color;

    public function __toString()
    {
        return parent::__toString() . ' (szín: ' . $this->color . ")";
    }
}
