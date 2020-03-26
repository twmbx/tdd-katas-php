<?php

declare(strict_types=1);

namespace Tests\GildedRose;

use App\GildedRoseKata\GildedRose;
use App\GildedRoseKata\Item;

class GildedRoseTest extends \PHPUnit\Framework\TestCase
{
    private const AGED_BRIE = "Aged Brie";
    private const SULFURUS = "Sulfuras, Hand of Ragnaros";
    private const BACK_PASS = "Backstage passes to a TAFKAL80ETC concert";
    private const CONJURED = "Conjured Mana Cake";
    private const DEX_VEST = "+5 Dexterity Vest";
    private const ELIXIR = "Elixir Of The Mongoose";

    public function gildedRoseProvider()
    {
        return [
            'Test Dexterity Vest decreases in quality by 1 normal' => [new Item(self::DEX_VEST, 10, 20), new Item(self::DEX_VEST, 9, 19)],

            'Test Elixir decreases in quality by 1 normal' => [new Item(self::ELIXIR, 5, 7), new Item(self::ELIXIR, 4, 6)],

            'Test Aged Brie increases in quality by 1 normal' => [new Item(self::AGED_BRIE, 5, 0), new Item(self::AGED_BRIE, 4, 1)],
            'Test Aged Brie increases in quality by 2 on sell date' => [new Item(self::AGED_BRIE, 0, 0), new Item(self::AGED_BRIE, -1, 2)],
            'Test Aged Brie increases in quality by 2 expired' => [new Item(self::AGED_BRIE, -5, 20), new Item(self::AGED_BRIE, -6, 22)],
            'Test Aged Brie will not increase quality over 50 normal' => [new Item(self::AGED_BRIE, 5, 50), new Item(self::AGED_BRIE, 4, 50)],
            'Test Aged Brie will not increase quality over 50 on sell date' => [new Item(self::AGED_BRIE, 0, 50), new Item(self::AGED_BRIE, -1, 50)],
            'Test Aged Brie will not increase quality over 50 expired' => [new Item(self::AGED_BRIE, -1, 50), new Item(self::AGED_BRIE, -2, 50)],
            'Test Aged Brie will not increase quality over 50 from 60 normal' => [new Item(self::AGED_BRIE, 5, 60), new Item(self::AGED_BRIE, 4, 50)],
            'Test Aged Brie will not increase quality over 50 from 60 on sell date' => [new Item(self::AGED_BRIE, 0, 60), new Item(self::AGED_BRIE, -1, 50)],
            'Test Aged Brie will not increase quality over 50 from 60 expired' => [new Item(self::AGED_BRIE, -1, 60), new Item(self::AGED_BRIE, -2, 50)],

            'Test Sulfurus quality can be 80 & does not change' => [new Item(self::SULFURUS, 10, 80), new Item(self::SULFURUS, 10, 80)],
            'Test Sulfurus stays same on sell date' => [new Item(self::SULFURUS, 0, 80), new Item(self::SULFURUS, 0, 80)],
            'Test Sulfurus stays same when expired' => [new Item(self::SULFURUS, -5, 80), new Item(self::SULFURUS, -5, 80)],

            'Test Back Pass increases in quality by 1 normal' => [new Item(self::BACK_PASS, 15, 1), new Item(self::BACK_PASS, 14, 2)],
            'Test Back Pass increases in quality by 1 11 days left' => [new Item(self::BACK_PASS, 11, 1), new Item(self::BACK_PASS, 10, 2)],
            'Test Back Pass increases in quality by 2 10 days left' => [new Item(self::BACK_PASS, 10, 1), new Item(self::BACK_PASS, 9, 3)],
            'Test Back Pass increases in quality by 2 6 days left' => [new Item(self::BACK_PASS, 6, 1), new Item(self::BACK_PASS, 5, 3)],
            'Test Back Pass increases in quality by 3 5 days left' => [new Item(self::BACK_PASS, 5, 1), new Item(self::BACK_PASS, 4, 4)],
            'Test Back Pass increases in quality by 3 2 days left' => [new Item(self::BACK_PASS, 2, 1), new Item(self::BACK_PASS, 1, 4)],
            'Test Back Pass drops to 0 quality 0 days left' => [new Item(self::BACK_PASS, 0, 20), new Item(self::BACK_PASS, -1, 0)],
            'Test Back Pass drops to 0 quality expired' => [new Item(self::BACK_PASS, -1, 20), new Item(self::BACK_PASS, -2, 0)],
            'Test Back Pass will not increase quality over 50 3 days left' => [new Item(self::BACK_PASS, 3, 50), new Item(self::BACK_PASS, 2, 50)],
            'Test Back Pass will not increase quality over 50(49) 3 days left' => [new Item(self::BACK_PASS, 3, 49), new Item(self::BACK_PASS, 2, 50)],

            'Test Conjured decreases in quality by 2' => [new Item(self::CONJURED, 15, 1), new Item(self::CONJURED, 14, -1)],
            'Test Conjured decreases in quality by 2' => [new Item(self::CONJURED, 4, 15), new Item(self::CONJURED, 3, 13)],
            'Test Conjured decreases in quality by 2' => [new Item(self::CONJURED, 0, 6), new Item(self::CONJURED, -1, 4)],
        ];
    }

    /**
     * @covers updateQuality
     * @dataProvider gildedRoseProvider
     */
    public function testUpdateQuality(Item $initial, Item $expected)
    {
        $gildedRose = new GildedRose($initial);
        $gildedRose->updateQuality();
        $this->assertEquals((string) $expected, (string) $initial);
    }
}
