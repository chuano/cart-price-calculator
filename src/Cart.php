<?php

declare(strict_types=1);

namespace App;

class Cart
{
    private array $lines;

    public function __construct()
    {
    }

    public function addLine(Item $item, int $amount): void
    {
        $this->lines[] = new Line($item, $amount);
    }

    /**
     * @return Line[]
     */
    public function getLines(): array
    {
        return $this->lines;
    }
}
