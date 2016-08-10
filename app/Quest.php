<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    public $timestamps = false;

    // player avaliable quests
    public static function avaliable_quests()
    {
        $quests = Quest::whereNotIn('id', function ($query) {
            $query->select('quest_id')
                ->from('users_quests')
                ->where('user_id', auth()->user()->id);
        })
            ->select(['quests.id', 'name', 'title', 'type', 'description', 'objetivos', 'recompensas', 'min_level', 'max_level', 'xp_reward', 'money_reward'])
            ->where('min_level', '<=', auth()->user()->level)
            ->limit(10)
            ->get();

        return $quests;
    }

    // player avaliable quests
    public static function accepted_quests()
    {
        $user_id = auth()->user()->id;

        $quests = Quest::join('users_quests', 'quests.id', '=', 'users_quests.quest_id')
            ->select(['quests.id', 'name', 'title', 'type', 'description', 'objetivos', 'recompensas', 'min_level', 'max_level', 'xp_reward', 'money_reward'])
            ->where('users_quests.user_id', $user_id)
            ->where('users_quests.completed', false)
            ->get();

        return $quests;
    }

}
