<?php

namespace App\Tests\Service;

use App\Service\FinancialApiClient;
use App\Service\StockService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class StockServiceTest extends TestCase
{
    function testGetHistoricalData()
    {
        $httpClientMock = new MockHttpClient($this->financialApiResponse());

        $financialApiClient = new FinancialApiClient($httpClientMock,
            'http://financial.api.com', 'key');

        $service = new StockService($financialApiClient);
        $from = (new \DateTime())->setDate(2020, 1, 1);
        $to = (new \DateTime())->setDate(2020, 5, 1);
        $history = $service->getHistory('ALL', $from, $to);

        $this->assertCount(2, $history->getPrices());
    }

    public function financialApiResponse()
    {
        $data = [
            'prices' => [
                [
                    'date' => 1562074200,
                    'open' => 20.790000915527,
                    'high' => 22.450000762939,
                    'low' => 20.200000762939,
                    'close' => 22.370000839233,
                    'volume' => 42111300,
                    'adjclose'=> 22.370000839233
                ],
                [
                    'date' => 1561987800,
                    'open' => 19.770000457764,
                    'high' => 19.860000610352,
                    'low'=> 19.170000076294,
                    'close' => 19.239999771118,
                    'volume' => 4669400,
                    'adjclose' => 19.239999771118,
                ]
            ],
            'isPending' => '',
            'firstTradeDate' => 733674600,
            'id' => '1d15464484001562086800',
            'timeZone' => [
                'gmtOffset' => -14400
            ],

            'eventsData' => []
        ];

        return new MockResponse(json_encode($data), ['http_code' => 200]);
    }
}