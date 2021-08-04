<?php

namespace Tests\CartPriceCalculator;

use App\Cart;
use App\CartPriceCalculator\CartPriceCalculator;
use App\Item;
use PHPUnit\Framework\TestCase;

class CartPriceCalculatorTest extends TestCase
{
    private Item $aaaItem;
    private Item $bbbItem;
    private Item $cccItem;
    private Item $dddItem;

    protected function setUp(): void
    {
        $this->aaaItem = new Item('AAA', 100);
        $this->bbbItem = new Item('BBB', 55);
        $this->cccItem = new Item('CCC', 25);
        $this->dddItem = new Item('DDD', 25);
    }

    /** @test */
    public function should_return_(): void
    {
        $cart = new Cart();
        $cart->addLine($this->aaaItem, 4); // 300
        $cart->addLine($this->bbbItem, 1); // 52,25
        $cart->addLine($this->cccItem, 1); // 25
        $cart->addLine($this->dddItem, 1); // 22.5
        $priceCalculator = new CartPriceCalculator();

        $this->assertEquals(399.75, $priceCalculator->calc($cart));
    }
}
