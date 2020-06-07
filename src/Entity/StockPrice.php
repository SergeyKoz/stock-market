<?php

namespace App\Entity;

class StockPrice
{
    private $date;

    private $open;

    private $high;

    private $low;

    private $close;

    private $volume;

    private $adjclose;

    public function __construct(
        int $date, float $open, float $high, float $low, float $close, int $volume, float $adjclose){
        $this->date = $date;
        $this->open = $open;
        $this->high = $high;
        $this->low = $low;
        $this->close = $close;
        $this->volume = $volume;
        $this->adjclose = $adjclose;
    }

    public function getDate(): int
    {
        return $this->date;
    }

    public function getOpen(): float
    {
        return $this->open;
    }

    public function getHigh(): float
    {
        return $this->high;
    }

    public function getLow(): float
    {
        return $this->low;
    }

    public function getClose(): float
    {
        return $this->close;
    }

    public function getAdjclose(): float
    {
        return $this->adjclose;
    }

    public function getVolume(): int
    {
        return $this->volume;
    }

    static function createFromArray(array $data): StockPrice
    {
        return new StockPrice(
            (int)$data['date'],
            (float)$data['open'],
            (float)$data['high'],
            (float)$data['low'],
            (float)$data['close'],
            (int)$data['volume'],
            (float)$data['adjclose']
        );
    }
}
