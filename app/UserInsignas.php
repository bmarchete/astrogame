<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInsignas extends Model
{

	// @ TODO: finish
    public static function all(){
    	return UserInsignas::join('')->where('user_id', auth()->user()->id)->get();
    }
}
