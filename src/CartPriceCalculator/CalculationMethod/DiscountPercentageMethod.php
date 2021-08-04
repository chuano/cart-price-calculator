<?php

declare(strict_types=1);

namespace App\CartPriceCalculator\CalculationMethod;

use App\Item;
use App\Line;

class DiscountPercentageMethod extends CalculationMethod
{
    private array $itemsApplicable;
    private int $percentage;

    public function __construct(array $itemsApplicable, int $percentage)
    {
        $this->itemsApplicable = $itemsApplicable;
        $this->percentage = $percentage;
    }

    public function calcLinePrice(Line $line): float
    {
        if ($this->isApplicable($line->getItem())) {
            $total = $this->calcPriceByUnits(
                $line->getAmount(),
                $line->getItem()->getUnitaryPrice()
            );
            $discount = $total * ($this->percentage / 100);

            return $total - $discount;
        }

        return $this->next->calcLinePrice($line);
    }

    private function isApplicable(Item $item): bool
    {
        return in_array($item->getName(), $this->itemsApplicable, true);
    }
}
