<?php

namespace Storage;

abstract class Product
{
    public function __construct($name, $brand, $sku, $price)
    {
        $this->name = $name;
        $this->sku = $sku;
        $this->brand = $brand;
        $this->price = $price;
    }

    private $brand;
    private $sku;
    private $name;
    private $price;

    public function getSku()
    {
        return $this->sku;
    }

    public function __toString()
    {
        return $this->brand . ' ' . $this->name . ', #' . $this->sku . ', ' . $this->price . ' Ft'; 
    }
}
