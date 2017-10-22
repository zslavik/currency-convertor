<?php

namespace App\Http\Controllers\Api;


use App\CurrencySymbol;
use App\Services\CurrencyService;
use Illuminate\Http\Request;

class CurrencyCalculatorController
{
    private $response;
    private $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    public function calculate(Request $request){ //todo add form request
        $rates = $this->currencyService->getLast();

        $this->response = CurrencySymbol::BASE_SYMBOL == $request->from ? $request->amount : ($request->amount / $rates[$request->from]);
        return response()->json(round(CurrencySymbol::BASE_SYMBOL == $request->to ? $this->response : ($this->response * $rates[$request->to]), 4));
    }

}