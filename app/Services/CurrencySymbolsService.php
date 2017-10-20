<?php

namespace App\Services;


use App\CurrencySymbol;

class CurrencySymbolsService
{
    public function allNamesAndId(){
        return CurrencySymbol::get()->keyBy('name')->map(function($model){
            return $model->id;
        });
    }

    public function allNames(){
        return CurrencySymbol::get()->pluck('name');
    }

}