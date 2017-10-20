<?php

namespace App\Support\CurrencyClient\Resources;


interface ResourcesInterface
{
    public function getUrl(array $currencies = null);
    public function getResponse($data);

}