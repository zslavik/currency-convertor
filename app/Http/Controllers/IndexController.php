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
}
