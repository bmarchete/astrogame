<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInsignas extends Model
{
    public function insigna(){
        return $this->belongsTo('App\Insignas');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
