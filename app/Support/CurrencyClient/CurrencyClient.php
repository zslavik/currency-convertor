<?php

namespace App\Support\CurrencyClient;

use App\Support\CurrencyClient\Resources\ResourcesInterface;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class CurrencyClient
{
    private $resource;
    private $httpClient;

    public function __construct(ResourcesInterface $resource)
    {
        $this->resource = $resource;
        $this->httpClient = new Client();
    }

    public function request()
    {
        try {
            $res = $this->httpClient->get($this->resource->getUrl());
            return $this->resource->getResponse($res->getBody());
        } catch (\Exception $e) {
            Log::error('Currency client: ' . json_encode($e->getMessage()));
            return false;
        }

    }

}