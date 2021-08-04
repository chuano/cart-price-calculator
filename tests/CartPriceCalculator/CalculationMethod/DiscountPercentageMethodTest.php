<?php

namespace Tests\CartPriceCalculator\CalculationMethod;

use App\CartPriceCalculator\CalculationMethod\DiscountPercentageMethod;
use App\Item;
use App\Line;
use PHPUnit\Framework\TestCase;

class DiscountPercentageMethodTest extends TestCase
{
    private Item $aaaItem;
    private Item $bbbItem;

    protected function setUp(): void
    {
        $this->aaaItem = new Item('AAA', 100);
        $this->bbbItem = new Item('BBB', 55);
    }

    /** @test */
    public function should_apply_given_discount_percentage(): void
    {
        $line = new Line($this->aaaItem, 1);
        $discountPercentageMethod = new DiscountPercentageMethod(['AAA'], 10);
        $this->assertEquals(90, $discountPercentageMethod->calcLinePrice($line));
    }

    /** @test */
    public function should_not_apply_given_discount_percentage_if_not_item_applicable(): void
    {
        $line = new Line($this->bbbItem, 1);
        $discountPercentageMethod = new DiscountPercentageMethod(['AAA'], 10);
        $this->expectErrorMessage('Call to a member function calcLinePrice() on null');
        $discountPercentageMethod->calcLinePrice($line);
    }
}
