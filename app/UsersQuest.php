<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Quest;

class UsersQuest extends Model
{
    public $quest_id = 0;
    public $user_id = 0;

    // primeira função que você deve executar! 
    public function quest($quest_id){
        if(!empty($quest_id)){
            $this->user_id = auth()->user()->id;
            $this->quest_id = $quest_id;
        } else {
            die('Você precisa determinar a quest id antes');
        }
    }

    private function quests_exists(){
        return (Quest::select('id')->where('id', $this->quest_id)->limit(1)->get()->first()) ? true : false;
    }

    private function user_quest_exists(){
        return UsersQuest::select('completed', 'quest_id')->where('quest_id', $this->quest_id)->where('user_id', $this->user_id)->limit(1)->get()->first();
    }

    /**
     * Aceitar uma quest com o usuário atual autenticado
     *
     * @return boolean insert quest
     */
    public function accept_quest(){
    	if($this->quests_exists() && empty($this->user_quest_exists())) {
            return UsersQuest::insert(['quest_id' => $this->quest_id, 'user_id' => $this->user_id]);
    	}
    }

    /**
     * Cancela uma quest com o usuário atual autenticado
     *
     * @return boolean delete quest
     */
    public function cancel_quest(){
    	if($this->quests_exists()) {
    		return $this->user_quest_exists()->delete();	
    	}
    }

    /**
     * Completa uma quest com o usuário atual autenticado
     *
     * @return boolean insert quest
     */
    public function complete_quest(){
        $quest = $this->user_quest_exists();
        if($quest && $quest->completed == false){
            return DB::table('users_quests')->where('quest_id', $quest_id)->where('user_id', $this->user_id)->update(['completed' => true]);
        }
    }
}
