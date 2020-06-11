<?php

namespace App\Manager;

use App\Service\ApiClient;
use App\Entity\Product;

class ProductManager
{
    private $client;

    public function __construct(ApiClient $apiClient) {
        $this->client = $apiClient;
    }

    public function addProduct(Product $product): bool
    {
        $response = $this->client->post('/api/product/add', [
            'id'=> $product->getId(),
            'name'=> $product->getName(),
            'manager'=> $product->getManager(),
            'salesStartDate' => $product->getSalesStartDate()->format('Y-m-d'),
        ]);

        return $response->getStatusCode() === 201;
    }
}