<?php

namespace Ruslanstarikov\Articleforge;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;

class ArticleForgeClient
{
    public const BASE_URL = 'https://af.articleforge.com';

    /** @var string */
    private $apiKey;

    /** @var Client */
    private Client $client;

    public function __construct(string $apiKey, Client $client = null)
    {
        $this->apiKey = $apiKey;
        if(!empty($client))
            $this->client = $client;
        else {
            $this->client = new Client([
                'base_uri' => self::BASE_URL,
                'timeout' => 20.0,
            ]);
        }
    }

    public function callApi(string $endpoint, array $payload = []): ?array
    {
        $payload['key'] = $this->apiKey;

        try {
            $response = $this->client->post($endpoint, [
                'form_params' => $payload,
                'headers' => [  
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ]
            ]);
            $responseBody = $response->getBody()->getContents();
        }
        catch(BadResponseException $badResponseException)
        {
            $response = $badResponseException->getResponse();
            $responseBody = $response->getBody()->getContents();
        }
        return json_decode($responseBody, true);
    }
}