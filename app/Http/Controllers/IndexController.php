<?php

namespace App\Http\Controllers;

use App\CurrencySymbol;
use App\Services\CurrencyService;
use App\Services\CurrencySymbolsService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    private $currencyService;
    private $currencySymbolsService;
    private $response;

    public function __construct(CurrencyService $currencyService,
                                CurrencySymbolsService $currencySymbolsService)
    {
        $this->currencyService = $currencyService;
        $this->currencySymbolsService = $currencySymbolsService;
    }

    public function index()
    {
        return view('index.index', [
            'symbols' => $this->currencySymbolsService->allNames()
        ]);
    }

    public function calculate(Request $request) //todo add form request
    {
        $rates = $this->currencyService->getLast();
        $this->response == CurrencySymbol::BASE_SYMBOL ? $request->amount : ($request->amount / $rates[$request->from]);
        return response()->json(CurrencySymbol::BASE_SYMBOL ? $this->response : ($this->response * $rates[$request->to]));
    }
}
