<?php

declare(strict_types=1);

namespace App\CartPriceCalculator\CalculationMethod;

use App\Line;

abstract class CalculationMethod
{
    protected ?CalculationMethod $next = null;

    public function chain(CalculationMethod $method): void
    {
        if ($this->next) {
            $this->next->chain($method);
        } else {
            $this->next = $method;
        }
    }

    public function calcPriceByUnits(int $amount, float $unitaryPrice): float
    {
        return $amount * $unitaryPrice;
    }

    abstract public function calcLinePrice(Line $line): float;
}
