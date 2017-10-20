<?php

namespace App\Support\Traits;


trait ModelTrait
{
    public static function getTableName(){
        return with(new self())->getTable();
    }

}