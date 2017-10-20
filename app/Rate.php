<?php

namespace App;

use App\Support\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use ModelTrait;

    protected $fillable = [
        'currency_symbol_id',
        'rate'
    ];

    public function currency(){
        return $this->hasOne(Currency::class);
    }
}
