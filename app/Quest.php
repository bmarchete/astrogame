<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Quest extends Model
{
	public $timestamps = false;

	// player avaliable quests
	public static function avaliable_quests(){
		$quests = Quest::whereNotIn('id', function($query) {
					        $query->select('quest_id')
					              ->from('users_quests')
					              ->where('user_id', Auth::user()->id);
					    })
					->where('min_level', '<=', Auth::user()->level)
					->limit(10)
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
