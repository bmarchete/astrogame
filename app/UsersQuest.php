<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersQuest extends Model
{

    private function user_quest_exists()
    {
        return self::where('quest_id', $this->quest_id)->where('user_id', $this->user_id)->limit(1)->first();
    }

    /**
     * Aceitar uma quest com o usuário atual autenticado.
     *
     * @return bool insert quest
     */
    public function accept_quest()
    {
        if (empty($this->user_quest_exists())) {
            return self::insert(['quest_id' => $this->quest_id, 'user_id' => $this->user_id]);
        }
    }

    /**
     * Cancela uma quest com o usuário atual autenticado.
     *
     * @return bool delete quest
     */
    public function cancel_quest()
    {
        return $this->user_quest_exists()->delete();
    }

    /**
     * Completa uma quest com o usuário atual autenticado.
     *
     * @return bool insert quest
     */
    public function complete_quest()
    {
        $quest = $this->user_quest_exists();
        if ($quest && $quest->completed == false) {
            $quest->completed = true;

            return $quest->save();
        } else {
            return false;
        }
    }

    public function quest_info()
    {
        return $this->belongsTo('App\Quest', 'quest_id');
    }

    public static function is_quest_taken($quest_id, User $user)
    {
        if (self::select('user_id')->where('quest_id', $quest_id)->where('user_id', $user->id)->first()) {
            return true;
        } else {
            return false;
        }
    }
}
