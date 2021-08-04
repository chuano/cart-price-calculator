<?php

declare(strict_types=1);

namespace App\CartPriceCalculator\CalculationMethod;

use App\Line;

class ThreeForTwoMethod extends CalculationMethod
{
    private array $itemsApplicable;

    public function __construct(array $itemsApplicable)
    {
        $this->itemsApplicable = $itemsApplicable;
    }

    public function calcLinePrice(Line $line): float
    {
        if ($this->isApplicable($line)) {
            $appliedThreByFourAmount = (int)($line->getAmount() - floor($line->getAmount() / 3));

            return $this->calcPriceByUnits(
                $appliedThreByFourAmount,
                $line->getItem()->getUnitaryPrice()
            );
        }

        return $this->next->calcLinePrice($line);
    }

    private function isApplicable(Line $line): bool
    {
        $itemIsApplicable = in_array($line->getItem()->getName(), $this->itemsApplicable, true);
        $isMultiple = $line->getAmount() >= 3;

        return $isMultiple && $itemIsApplicable;
    }
}
