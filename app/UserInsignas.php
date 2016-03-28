<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInsignas extends Model
{
    public static function all(){
    	return UserInsignas::join('')->where('user_id', auth()->user()->id)->get();
    }
}
