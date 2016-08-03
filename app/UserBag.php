<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBag extends Model
{
    public function item(){
        return $this->belongsTo('App\Item');
    }
}
