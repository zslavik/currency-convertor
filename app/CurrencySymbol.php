<?php

namespace App;

use App\Support\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class CurrencySymbol extends Model
{
    use ModelTrait;

    const BASE_SYMBOL = 'USD';

}
