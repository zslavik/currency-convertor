<?php

namespace App\Services;


use App\Currency;
use App\CurrencySymbol;
use App\Rate;
use App\Support\CurrencyClient\CurrencyClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CurrencyService
{
    private $currencyClient;
    private $currencySymbolsService;
    private $response;

    public function __construct(CurrencyClient $currencyClient,
                                CurrencySymbolsService $currencySymbolsService)
    {
        $this->currencyClient = $currencyClient;
        $this->currencySymbolsService = $currencySymbolsService;
    }

    public function getRates()
    {
        return $this->currencyClient->request();
    }

    public function save()
    {
        $symbols = $this->currencySymbolsService->allNamesAndId();
        $rates = $this->getRates();
        if ($rates && $symbols) {
            $currency = Currency::create([
                'currency_symbol_id' => $this->getBaseCurrency(),
            ]);
            if ($currency) {
                foreach ($rates as $symbol => $rate) {
                    $currency->rates()->create([
                        'currency_symbol_id' => $symbols[$symbol],
                        'rate' => $rate
                    ]);
                }
            }
        }
    }

    public function getBaseCurrency()
    {
        return CurrencySymbol::where('name', CurrencySymbol::BASE_SYMBOL)->pluck('id')->first();
    }

    public function getLast()
    {
        $currencySymbolTableName = CurrencySymbol::getTableName();
        $currencyTableName = Currency::getTableName();
        $rateTableName = Rate::getTableName();
        if (!$rates = Cache::get('rates')) {
            $rates = Rate::leftJoin($currencySymbolTableName, $currencySymbolTableName . '.id', '=', $rateTableName . '.currency_symbol_id')
                ->leftJoin($currencyTableName, $currencyTableName . '.id', '=', $rateTableName . '.currency_id')
                ->select($rateTableName . '.*', $currencySymbolTableName . '.name')
                ->where($currencyTableName . '.currency_symbol_id', $this->getBaseCurrency())->get()->keyBy('name')->map(function ($model) {
                    return $model->rate;
                });
            Cache::put('rates', $rates, 60);
        }
        return $rates;
    }

    public function calculate(Request $request)
    {
        $rates = $this->getLast();
        try {
            $this->response = CurrencySymbol::BASE_SYMBOL == $request->from
                ? $request->amount : ($request->amount / $rates[$request->from]);
            $this->response = CurrencySymbol::BASE_SYMBOL == $request->to
                ? $this->response : ($this->response * $rates[$request->to]);
            return round($this->response, 4);
        } catch (\Exception $e) {
            Log::error('Calculate: ' . $e->getMessage());
            return false;
        }
    }

}