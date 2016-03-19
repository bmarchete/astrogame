<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class UsersQuest extends Model
{
    public static function accept_quest($quest_id){
    	$user_id = Auth::user()->id;
    	$check_quest = UsersQuest::select('quest_id')->where('quest_id', $quest_id)->where('user_id', $user_id)->limit(1)->get()->first();
    	if(!$check_quest) {
    		$user_quest = new UsersQuest;
    		$user_quest->quest_id = $quest_id;
    		$user_quest->user_id = $user_id;
    		return $user_quest->save();	
    	}
    }

    public static function cancel_quest($quest_id){
    	$user_id = Auth::user()->id;
    	$check_quest = UsersQuest::select('quest_id')->where('quest_id', $quest_id)->where('user_id', $user_id)->limit(1)->get()->first();
    	if($check_quest) {
    		return $check_quest->delete();	
    	}
    }

    public function complete_quest($quest_id){
    	$user_id = Auth::user()->id;

    }
}
