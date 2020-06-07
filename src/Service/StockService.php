<?php

namespace App\Service;

use App\Entity\StockHistory;
use App\Entity\StockPrice;
use DateTime;

class StockService
{
    private FinancialApiClient $financialApiClient;

    /**
     * StockService constructor.
     * @param FinancialApiClient $financialApiClient
     */
    public function __construct(FinancialApiClient $financialApiClient){
        $this->financialApiClient = $financialApiClient;
    }

    /**
     * @param string $companySymbol
     * @param DateTime $from
     * @param DateTime $to
     * @return StockHistory
     */
    public function getHistory(string $companySymbol, DateTime $from, DateTime $to): StockHistory
    {
        $stockHistory = $this->financialApiClient->getStockHistory($companySymbol, $from->getTimestamp(), $to->getTimestamp());
        $prices = [];
        foreach ($stockHistory['prices'] as $item) {
            $prices[] = StockPrice::createFromArray($item);
        }
        return new StockHistory($prices);
    }
}