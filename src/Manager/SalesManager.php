<?php

namespace App\Manager;

use App\Service\ApiClient;

class SalesManager
{
    private $client;

    public function __construct(ApiClient $apiClient)
    {
        $this->client = $apiClient;
    }

    public function getSales(): string
    {
        $response = $this->client->get('/api/sales');

        return $response->getContent();
    }
}