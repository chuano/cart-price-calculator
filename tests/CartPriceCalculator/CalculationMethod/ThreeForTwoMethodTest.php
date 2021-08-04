<?php

namespace Tests\CartPriceCalculator\CalculationMethod;

use App\CartPriceCalculator\CalculationMethod\ThreeForTwoMethod;
use App\Item;
use App\Line;
use PHPUnit\Framework\TestCase;

class ThreeForTwoMethodTest extends TestCase
{
    private Item $aaaItem;
    private Item $bbbItem;

    protected function setUp(): void
    {
        $this->aaaItem = new Item('AAA', 100);
        $this->bbbItem = new Item('BBB', 55);
    }

    /** @test */
    public function should_apply_three_for_two_discount(): void
    {
        $line = new Line($this->aaaItem, 3);
        $threeForTwoMethod = new ThreeForTwoMethod(['AAA']);
        $this->assertEquals(200, $threeForTwoMethod->calcLinePrice($line));
    }

    /** @test */
    public function should_not_apply_if_not_item_applicable(): void
    {
        $line = new Line($this->bbbItem, 3);
        $threeForTwoMethod = new ThreeForTwoMethod(['AAA']);
        $this->expectErrorMessage('Call to a member function calcLinePrice() on null');
        $threeForTwoMethod->calcLinePrice($line);
    }

    /** @test */
    public function should_not_apply_if_less_than_three_items(): void
    {
        $line = new Line($this->aaaItem, 2);
        $threeForTwoMethod = new ThreeForTwoMethod(['AAA']);
        $this->expectErrorMessage('Call to a member function calcLinePrice() on null');
        $threeForTwoMethod->calcLinePrice($line);
    }

    /** @test */
    public function should_apply_three_for_two_discount_given_more_than_three_items(): void
    {
        $line = new Line($this->aaaItem, 4);
        $threeForTwoMethod = new ThreeForTwoMethod(['AAA']);
        $this->assertEquals(300, $threeForTwoMethod->calcLinePrice($line));
    }
}
