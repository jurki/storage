<?php

require 'vendor/autoload.php';

use Storage\Storage;
use Storage\Brand;
use Storage\SmallCar;
use Storage\Truck;

try {
    new Storage('Budapest', '1148 Budapest, Örs vezér tere 22.', 10);
    new Storage('Budaörs', '2040 Budaörs, Sport utca 2–4.', 20);
    new Storage('Soroksár', '1239 Budapest, Vecsés út, 195836/32 hrsz', 30);

    $skoda = new Brand('Skoda', 3);
    $volkswagen = new Brand('Volkswagen', 4);
    $audi = new Brand('Audi', 5);
    $sentinel = new Brand('Sentinel', 1);

    $volkswagenPolo = new SmallCar('Polo', $volkswagen, 'vw1', 100, 'fehér');
    $sentinelS4 = new Truck('S4', $sentinel, 's4', 30, 'gőz');
    $audiS4 = new SmallCar('S4', $audi, 'audis4', 3000, 'fekete');

    Storage::addStock($volkswagenPolo, 11);
    Storage::addStock($sentinelS4, 2);
    Storage::addStock($audiS4, 16);
    Storage::addStock($volkswagenPolo, 2);

    echo Storage::print();

    echo "-------------------------------<br>";

    $getProducts = Storage::removeStock("vw1", 12);
    echo Storage::print();
} catch (\Exception $e) {
    echo "Jaj, ban van: " . $e->getMessage();
}
