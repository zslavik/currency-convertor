<?php

namespace App\Support\CurrencyClient\Resources;

use App\CurrencySymbol;

class FixerIOResource implements ResourcesInterface
{
    const URL = 'http://api.fixer.io/';

    public function getUrl()
    {
        return self::URL . '/latest?base=' . CurrencySymbol::BASE_SYMBOL;
    }

    public function getResponse($data){
        return json_decode($data)->rates ?? [];
    }

}