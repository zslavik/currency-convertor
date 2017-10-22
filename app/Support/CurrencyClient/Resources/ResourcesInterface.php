<?php

namespace App\Support\CurrencyClient\Resources;


interface ResourcesInterface
{
    public function getUrl();
    public function getResponse($data);

}