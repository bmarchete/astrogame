<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Quest extends Model
{
	public $timestamps = false;

	// player avaliable quests
	public static function avaliable_quests(){
		$quests = Quest::get();
		return $quests;
	}
}
