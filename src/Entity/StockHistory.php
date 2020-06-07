<?php

namespace App\Entity;

class StockHistory
{
    private array $prices;

    public function __construct(array $prices){
        $this->prices = $prices;
    }

    public function getPrices(): array
    {
        return $this->prices;
    }
}
