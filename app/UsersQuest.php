<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use User;

class UsersQuest extends Model
{
    public function lists_quests_accepted(){

    }

    public function lists_quests_completes(){
    	
    }

    public function complete_quest($quest_id){
    	$user_id = Auth::user()->id;

    }
}
