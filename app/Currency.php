<?php

namespace App;

use App\Support\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use ModelTrait;

    protected $fillable = [
        'currency_symbol_id'
    ];

    public function rates(){
        return $this->hasMany(Rate::class);
    }
}
