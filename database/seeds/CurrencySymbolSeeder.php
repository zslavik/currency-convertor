<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySymbolSeeder extends Seeder
{
    private $symbols = [
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
        'ZAR',
        'USD'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currency_symbols')->insert(array_map(function ($symbol) {
            return [
                'name' => $symbol,
            ];
        }, $this->symbols));
    }


}
