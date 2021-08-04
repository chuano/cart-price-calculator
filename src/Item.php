<?php

declare(strict_types=1);

namespace App;

class Item
{
    private string $name;
    private float $unitaryPrice;

    public function __construct(string $name, float $unitaryPrice)
    {
        $this->name = $name;
        $this->unitaryPrice = $unitaryPrice;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUnitaryPrice(): float
    {
        return $this->unitaryPrice;
    }
}
