<?php

declare(strict_types=1);

namespace App\CartPriceCalculator\CalculationMethod;

use App\Line;

class NoDiscountMethod extends CalculationMethod
{
    public function calcLinePrice(Line $line): float
    {
            return $this->calcPriceByUnits(
                $line->getAmount(),
                $line->getItem()->getUnitaryPrice()
            );
    }
}
