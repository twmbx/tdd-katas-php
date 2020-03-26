<?php

declare(strict_types=1);

namespace App\GildedRoseKata;

/**
 * Item class is final so cannot be extended to apply strict types
 * and cannot be edited as part of the rules of this Kata
 * Ideally one would create a child class of Item for each Item case
 * in order to enforce strict types on the ChildItem properties.
 */
final class GildedRose
{

    private $items = [];

    public function __construct(Item ...$items)
    {
        $this->items = $items;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {

            switch ($item->name) {
                case 'Conjured Mana Cake':
                    $this->updateConjuredItem($item);
                    break;

                case 'Aged Brie':
                    $this->updateAgedBrie($item);
                    break;

                case 'Backstage passes to a TAFKAL80ETC concert':
                    $this->updateBackstageItem($item);
                    break;

                case 'Sulfuras, Hand of Ragnaros':
                    $this->updateSulfurusItem($item);
                    break;

                default:
                    $this->updateDefaultItem($item);
                    break;
            }
        }
    }

    /**
     * @psalm-suppress MixedOperand
     */
    private function updateAgedBrie(Item $item): void
    {
        $item->sell_in -= 1;
        $item->quality += 1;

        if (1 > $item->sell_in) {
            $item->quality += 1;
        }
        if (50 < $item->quality) {
            $item->quality = 50;
        }
    }

    /**
     * @psalm-suppress MixedOperand
     */
    private function updateConjuredItem(Item $item): void
    {
        $item->sell_in -= 1;
        $item->quality -= 2;
    }

    /**
     * @psalm-suppress MixedOperand
     */
    private function updateBackstageItem(Item $item): void
    {
        if (11 > $item->sell_in) {
            $item->quality += 1;
        }
        if (6 > $item->sell_in) {
            $item->quality += 1;
        }
        $item->quality += 1;

        if (1 > $item->sell_in) {
            $item->quality = 0;
        }
        if (50 < $item->quality) {
            $item->quality = 50;
        }
        $item->sell_in -= 1;
    }

    /**
     * @psalm-suppress MixedOperand
     */
    private function updateSulfurusItem(Item $item): void
    {
        $item->quality = 80;
    }

    /**
     * @psalm-suppress MixedOperand
     */
    private function updateDefaultItem(Item $item): void
    {
        $item->sell_in -= 1;
        $item->quality -= 1;
    }
}
