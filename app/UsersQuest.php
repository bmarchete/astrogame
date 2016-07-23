<?php

namespace App;

use App\Quest;
use Illuminate\Database\Eloquent\Model;

class UsersQuest extends Model
{
    // primeira função que você deve executar!
    public function quest($quest_id)
    {
        if (!empty($quest_id)) {
            $this->user_id  = auth()->user()->id;
            $this->quest_id = $quest_id;
        } else {
            die('Você precisa determinar a quest id antes');
        }
    }

    private function quests_exists()
    {
        return (Quest::select('id')->where('id', $this->quest_id)->limit(1)->first()) ? true : false;
    }

    private function user_quest_exists()
    {
        return UsersQuest::where('quest_id', $this->quest_id)->where('user_id', $this->user_id)->limit(1)->first();
    }

    /**
     * Aceitar uma quest com o usuário atual autenticado
     *
     * @return boolean insert quest
     */
    public function accept_quest()
    {
        if ($this->quests_exists() && empty($this->user_quest_exists())) {
            return UsersQuest::insert(['quest_id' => $this->quest_id, 'user_id' => $this->user_id]);
        }
    }

    /**
     * Cancela uma quest com o usuário atual autenticado
     *
     * @return boolean delete quest
     */
    public function cancel_quest()
    {
        if ($this->quests_exists()) {
            return $this->user_quest_exists()->delete();
        }
    }

    /**
     * Completa uma quest com o usuário atual autenticado
     *
     * @return boolean insert quest
     */
    public function complete_quest()
    {
        $quest = $this->user_quest_exists();
        if ($quest && $quest->completed == false) {
            $quest->completed = true;

            $this->reward_user($quest, auth()->user());
            $this->history_quest($quest->quest_info, auth()->user());
            return $quest->save();
        } else {
            return false;
        }
    }

    public function reward_user(UsersQuest $user_quest, User $user){
        // add xp
        $user->gain_xp($user_quest->quest_info->xp_reward);

        // add money
        $user->gain_money($user_quest->quest_info->money_reward);
    }

    public function history_quest(Quest $quest, User $user){
        $history = new \App\History;
        $history->user_id = $user->id;
        $history->texto = "Completou a quest <strong>" . $quest->title . "</strong> e ganhou " . $quest->xp_reward . " pontos de XP";
        $history->icon  = "exclamation";
        $history->save();
    }

    public function quest_info(){
        return $this->belongsTo('App\Quest', 'quest_id');
    }

    public static function is_quest_taken($quest_id, User $user){
        if(UsersQuest::select('user_id')->where('quest_id', $quest_id)->where('user_id', $user->id)->first()){
            return true;
        } else {
            return false;
        }
    }
}
