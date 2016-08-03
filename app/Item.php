<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $timestamps = false;

    public static function shop()
    {
        return Item::all();
    }
    
}
