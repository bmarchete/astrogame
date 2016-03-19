<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Quest extends Model
{
	public $timestamps = false;

	// player avaliable quests
	public static function avaliable_quests(){
		$user_id = Auth::user()->id;
		$quests = Quest::join('users_quests', 'quests.id', '!=', 'users_quests.quest_id')
					->where('users_quests.user_id', $user_id)
					->get();

		return $quests;
	}

	// player avaliable quests
	public static function accepted_quests(){
		$user_id = Auth::user()->id;
		
		$quests = Quest::join('users_quests', 'quests.id', '=', 'users_quests.quest_id')
					->select(['quests.id', 'title', 'type', 'description', 'objetivos', 'recompensas', 'min_level', 'max_level'])
					->where('users_quests.user_id', $user_id)
					->where('users_quests.completed', false)
					->get();
		
		return $quests;
	}

}
