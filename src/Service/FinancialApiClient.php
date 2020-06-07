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
    }
}