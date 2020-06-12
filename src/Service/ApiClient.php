<?php

namespace App\Service;

use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiClient
{
    protected $client;
    protected $baseUrl;

    public function __construct(HttpClientInterface $client) {
            $this->client = $client;
            # cd public
            # php -S localhost:8001
            $this->baseUrl = 'http://localhost:8001';
    }

    protected function buildUrl(string $url): string
    {
        if (strpos($url, '/') === 0) {
            return $this->baseUrl . $url;
        }

        return $this->baseUrl . '/' . $url;
    }

    private function request(string $method, string $url = '', array $options = [])
    {
        $url = $this->buildUrl($url);
        if (!empty($options)) {
            $options = ['json' => $options];
        }
        $options['auth_bearer'] = 'hardCodedBearerToken';
        try {
            $response = $this->client->request($method, $url, $options);
            $response->getContent(); // this will throw the exception in case of problem
        } catch (ClientException $e) {
            if ($e->getCode() === 404) {
                throw new \Exception('not found', 404);
            } elseif ($e->getCode() === 400) {
                $jsonError = $e->getResponse()->getContent(false);
                throw new \Exception($jsonError, 400);
            }
            // throw all the other Exceptions
            throw $e;
        }

        return $response;
    }

    final public function get(string $url)
    {
        return $this->request('GET', $url);
    }

    final public function post(string $url, array $data)
    {
        return $this->request('POST', $url, $data);
    }
}