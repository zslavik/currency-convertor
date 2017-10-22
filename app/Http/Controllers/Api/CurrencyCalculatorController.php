<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CalculateRequest;
use App\Services\CurrencyService;

class CurrencyCalculatorController
{
    private $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    public function calculate(CalculateRequest $request)
    {
        $response = $this->currencyService->calculate($request);
        if ($response) {
            return response()->json($this->currencyService->calculate($request));
        }
        abort(422, 'Not calculated');
    }

}