<?php

namespace App\Support\CurrencyClient;

use App\Support\CurrencyClient\Resources\ResourcesInterface;
use GuzzleHttp\Client;

class CurrencyClient
{
    private $resource;
    private $httpClient;

    public function __construct(ResourcesInterface $resource)
    {
        $this->resource = $resource;
        $this->httpClient = new Client();
    }

    public function request(){ //todo add try catch
        $res = $this->httpClient->get($this->resource->getUrl());
        return $this->resource->getResponse($res->getBody());
    }

}