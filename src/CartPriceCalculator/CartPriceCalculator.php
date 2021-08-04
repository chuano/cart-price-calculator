<?php

declare(strict_types=1);

namespace App\CartPriceCalculator;

use App\Cart;
use App\CartPriceCalculator\CalculationMethod\DiscountPercentageMethod;
use App\CartPriceCalculator\CalculationMethod\NoDiscountMethod;
use App\CartPriceCalculator\CalculationMethod\ThreeForTwoMethod;
use App\Line;

class CartPriceCalculator
{
    public function calc(Cart $cart): float
    {
        $method = new ThreeForTwoMethod(['AAA', 'DDD']);
        $method->chain(new DiscountPercentageMethod(['AAA', 'DDD'], 10));
        $method->chain(new DiscountPercentageMethod(['BBB'], 5));
        $method->chain(new NoDiscountMethod());

        return array_reduce(
            $cart->getLines(),
            static fn(float $total, Line $line) => $total += $method->calcLinePrice($line),
            0
        );
    }
}
