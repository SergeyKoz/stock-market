<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class FinancialApiClient
{
    private $httpClient;

    private $apiUrl;

    private $apiKey;

    /**
     * FinancialApiClient constructor.
     * @param HttpClientInterface $httpClient
     * @param string $financialApiUrl
     * @param string $financialApiKey
     */
    public function __construct(HttpClientInterface $httpClient, string $financialApiUrl, string $financialApiKey)
    {
        $this->httpClient = $httpClient;
        $this->apiKey = $financialApiKey;
        $this->apiUrl = $financialApiUrl;
    }

    public function getStockHistory(string $companySymbol, int $from, int $to): array
    {
        $response = $this->httpClient
            ->request('GET', $this->apiUrl . '/stock/v2/get-historical-data', [
                'query' => [
                    'period1' => $from,
                    'period2' => $to,
                    'symbol' => $companySymbol
                ],
                'headers' => [
                    'X-RapidAPI-Key' => $this->apiKey,
                ],
            ]
        );
        return $response->toArray();

//        return [
//            'prices' => [
//                [
//                    'date' => 1562074200,
//                    'open' => 20.790000915527,
//                    'high' => 22.450000762939,
//                    'low' => 20.200000762939,
//                    'close' => 22.370000839233,
//                    'volume' => 42111300,
//                    'adjclose'=> 22.370000839233
//                ],
//                [
//                    'date' => 1561987800,
//                    'open' => 19.770000457764,
//                    'high' => 19.860000610352,
//                    'low'=> 19.170000076294,
//                    'close' => 19.239999771118,
//                    'volume' => 4669400,
//                    'adjclose' => 19.239999771118,
//                ]
//            ],
//            'isPending' => '',
//            'firstTradeDate' => 733674600,
//            'id' => '1d15464484001562086800',
//            'timeZone' => [
//                'gmtOffset' => -14400
//            ],
//
//            'eventsData' => []
//        ];
    }
}