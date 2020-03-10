<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Storage\Storage;
use Storage\Brand;
use Storage\SmallCar;
use Storage\Truck;

final class StockAddTest extends TestCase
{
    private static $volkswagenPolo;
    private static $sentinelS4;
    private static $audiS4;
 
    public static function setUpBeforeClass(): void
    {
        new Storage('Budapest', '1148 Budapest, Örs vezér tere 22.', 10);
        new Storage('Budaörs', '2040 Budaörs, Sport utca 2–4.', 20);
        new Storage('Soroksár', '1239 Budapest, Vecsés út, 195836/32 hrsz', 30);

        $skoda = new Brand('Skoda', 3);
        $volkswagen = new Brand('Volkswagen', 4);
        $audi = new Brand('Audi', 5);
        $sentinel = new Brand('Sentinel', 1);

        self::$volkswagenPolo = new SmallCar('Polo', $volkswagen, 'vw1', 100, 'fehér');
        self::$sentinelS4 = new Truck('S4', $sentinel, 's4', 30, 'gőz');
        self::$audiS4 = new SmallCar('S4', $audi, 'audis4', 3000, 'fekete');
    }

    public function testQuantityCheck()
    {
        Storage::emptyAll();
    
        Storage::addStock(self::$volkswagenPolo, 11);
        Storage::addStock(self::$sentinelS4, 2);
        Storage::addStock(self::$audiS4, 16);
        Storage::addStock(self::$volkswagenPolo, 2);
    
        $getProducts = Storage::removeStock("vw1", 12);

        print("\nKészlet mennyiség teszt 1\n");
        $this->assertSame(Storage::getTotalQuantity(), 11 + 2 + 16 + 2 - 12);
    }

    public function testPrint()
    {
        Storage::emptyAll();    
        Storage::addStock(self::$volkswagenPolo, 11);
        Storage::addStock(self::$sentinelS4, 2);
        Storage::addStock(self::$audiS4, 16);
        Storage::addStock(self::$volkswagenPolo, 2);
        echo "\n" . Storage::print() . "\n";
        $this->assertTrue(true);
    }

    public function testTooMuchProduct()
    {
        Storage::emptyAll();    
        Storage::addStock(self::$volkswagenPolo, 110);
        $this->assertTrue(true);
    }

    public function testRemoveProducts()
    {
        Storage::emptyAll();    
        Storage::addStock(self::$volkswagenPolo, 10);
        Storage::addStock(self::$volkswagenPolo, 10);
        $getProducts = Storage::removeStock("vw1", 12);
        print("\nKészlet mennyiség teszt 2\n");
        $this->assertSame(Storage::getTotalQuantity(), 10 + 10 - 12);
    }
}