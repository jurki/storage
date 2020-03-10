<?php

namespace Storage;

class Brand
{
    public function __construct ($name, $qualityClass) {
        if (empty($name)) throw new \Exception('Brand name is missing');
        if (empty($qualityClass)) throw new \Exception('Quality class is missing');
        if (!is_integer($qualityClass) || $qualityClass < 1 || $qualityClass > 5) throw new \Exception('Quality class must be a number between 1 and 5');

        $this->name = $name;
        $this->qualityClass = $qualityClass;
    }

    protected $name;
    protected $qualityClass;

    public function __toString () {
        return $this->name . ' (' . str_repeat('*', $this->qualityClass) . ')';
    }
}
