<?php

namespace App\Callers;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Response as HttpResponse;
use GuzzleHttp\Client;

class HttpCaller
{
    private ?PendingRequest $client = null;

    public function getResponse(string $base_url, $method, $uri, array $parameters = [], array $headers = [])
    {
        return ($this->client ?: $this->getFreshClient($base_url))->withHeaders($headers)->$method($uri, $parameters);
    }

    /**
     * @throws RequestException
     */
    public function sendRequest(string $base_url, $method, $uri, array $parameters = [], array $headers = []): array
    {
        $headers = array_merge($headers, $this->getHeaders());

        $response = $this->getResponse($base_url, $method, $uri, $parameters, $headers)
            ->throw(function (Response $response) use ($parameters) {
                Log::critical('response failed', [
                        'url'      => $response->effectiveUri(),
                        'payload' => $parameters,
                        'response' => [
                            'error' => $response->json(), 'body' => $response->body(), 'json' => $response->json()
                        ]
                    ]);
            });

        return $response->json();
    }

    private function getFreshClient(string $base_url): PendingRequest
    {
        return $this->initClient($base_url, Http::async(false));
    }

    protected function initClient(string $base_url, PendingRequest $client): PendingRequest
    {
        return $client->timeout(90)
            ->baseUrl($base_url)
            ->acceptJson()
            ->contentType('application/json');
    }

    private function getHeaders(): array
    {
        return [
            'Content-Type'  =>  'application/json',
            'Accept'        => 'application/json',
        ];
    }
}
