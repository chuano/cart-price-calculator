<?php

namespace Tests\CartPriceCalculator\CalculationMethod;

use App\CartPriceCalculator\CalculationMethod\NoDiscountMethod;
use App\CartPriceCalculator\CalculationMethod\ThreeForTwoMethod;
use App\Item;
use App\Line;
use PHPUnit\Framework\TestCase;

class NoDiscountMethodTest extends TestCase
{
    private Item $aaaItem;

    protected function setUp(): void
    {
        $this->aaaItem = new Item('AAA', 100);
    }

    /** @test */
    public function should_apply_allways(): void
    {
        $line = new Line($this->aaaItem, 3);
        $noDiscount = new NoDiscountMethod();
        $this->assertEquals(300, $noDiscount->calcLinePrice($line));
    }
}
