<?php

declare(strict_types=1);

namespace App;

class Line
{
    private Item $item;
    private int $amount;

    public function __construct(Item $item, int $amount)
    {
        $this->item = $item;
        $this->amount = $amount;
    }

    public function getItem(): Item
    {
        return $this->item;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }
}
