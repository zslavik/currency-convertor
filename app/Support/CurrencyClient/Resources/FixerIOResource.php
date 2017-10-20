<?php

namespace App\Support\CurrencyClient\Resources;

use App\CurrencySymbol;
use League\Flysystem\NotSupportedException;

class FixerIOResource implements ResourcesInterface
{
    const URL = 'http://api.fixer.io/';
    const SUPPORTED_CURRENCIES = [
        'AUD',
        'BGN',
        'BRL',
        'CAD',
        'CHF',
        'CNY',
        'CZK',
        'DKK',
        'GBP',
        'HKD',
        'HRK',
        'HUF',
        'IDR',
        'ILS',
        'INR',
        'JPY',
        'KRW',
        'MXN',
        'MYR',
        'NOK',
        'NZD',
        'PHP',
        'PLN',
        'RON',
        'RUB',
        'SEK',
        'SGD',
        'THB',
        'TRY',
        'EUR',
        'ZAR'
    ];

    public function getUrl(array $currencies = null)
    {
        return self::URL . '/latest?base=' . CurrencySymbol::BASE_SYMBOL . '&' . ($currencies ? $this->getCurrenciesExistUrl($currencies): '');
    }

    public function getResponse($data){
        return json_decode($data)->rates ?? [];
    }

    private function getCurrenciesExistUrl($currencies){
        $exists = array_intersect(self::SUPPORTED_CURRENCIES, $currencies);
        if($exists){
            return '/?' . implode(',', $exists);
        }
        throw new NotSupportedException();
    }


}