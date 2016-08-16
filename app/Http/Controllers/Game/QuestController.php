<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UsersQuest;
use App\Quest;
use App\History;
use App\User;
use App\Http\Requests\QuestRequest;
use Validator;

class QuestController extends GameController
{
    public function quest_accept(QuestRequest $request)
    {
        $quest_id = $request->id;

        $quest_user = new UsersQuest();
        $quest_user->quest_id = $quest_id;
        $quest_user->user_id = auth()->user()->id;

        $status = ($quest_user->accept_quest()) ? true : false;

        return response()->json(['accepted' => $status]);
    }

    public function quest_cancel(QuestRequest $request)
    {
        $quest_id = $request->id;

        $quest_user = new UsersQuest();
        $quest_user->quest_id = $quest_id;
        $quest_user->user_id = auth()->user()->id;

        $status = ($quest_user->cancel_quest()) ? true : false;

        return response()->json(['canceled' => $status]);
    }

    public function quest_complete(Request $request)
    {
        $quest = Quest::select('id')->where('name', $request->name)->limit(1)->first();
        if(!$quest){
            return response()->json(['status' => false, 'text' => 'Nenhuma quest com esse nome encontrada']);
        }
        $quest_id = $quest->id;

        $quest_user = new UsersQuest();
        $quest_user->quest_id = $quest_id;
        $quest_user->user_id = auth()->user()->id;

        if ($quest_user->complete_quest()) {
            $this->reward_user($quest_user, auth()->user());

            if($quest_user->quest_info->type == 2){
                $this->history_quest_chapter($quest_user->quest_info, auth()->user());
            } else {
                $this->history_quest($quest_user->quest_info, auth()->user());
            }

            session()->put('notify',
            [
                ['text' => '<i class="uk-icon-exclamation"></i> Missão: '.$quest_user->quest_info->title.' completada', 'status' => 'success', 'timeout' => 3000],
                ['text' => '<i class="uk-icon-money"></i> Ganhou: '.$quest_user->quest_info->money_reward.' de dinheiro', 'status' => 'warning', 'timeout' => 3000],
                ['text' => '<i class="uk-icon-arrow-up"></i> Ganhou: '.$quest_user->quest_info->xp_reward.' de XP ', 'status' => 'warning', 'timeout' => 3000],
            ]);
            return response()->json(['status' => true]);
        } else {
            session()->put('notify',
            [
              ['text' => '<i class="uk-icon-exclamation"></i> Erro ao completar a missão ' . $quest_user->quest_info->title, 'status' => 'danger', 'timeout' => 4000],
            ]);
            return response()->json(['status' => false]);
        }


    }

    public function reward_user(UsersQuest $user_quest, User $user)
    {
        $user->gain_xp($user_quest->quest_info->xp_reward);
        $user->gain_money($user_quest->quest_info->money_reward);
        // @TODO: $user->gain_insigna($user_quest->quest_info->insigna_reward);
    }

    public function history_quest(Quest $quest, User $user)
    {
        $history = new History();
        $history->user_id = $user->id;
        $history->texto = 'Completou a quest <strong>'.$quest->title.'</strong> e ganhou '.$quest->xp_reward.' pontos de XP';
        $history->icon = 'exclamation';
        $history->save();
    }


    // @TODO: modal com as informações da quest no perfil
    public function history_quest_chapter(Quest $quest, User $user)
    {
        $history = new History();
        $history->user_id = $user->id;
        $history->texto = "Completou o capítulo <strong>" . $quest->title . "</strong>";
        $history->icon = "space-shuttle";
        $history->save();
    }

    // ========================================
    // quests
    public function quest(Request $request)
    {

        $validator = Validator::make(['name' => $request->name], [
            'name' => 'required|max:255|exists:quests,name',
        ]);

        if(!$validator->fails()){
            return view('game.quests.' . $request->name);
        } else {

            session()->put('notify',
            [
                ['text' => '<i class="uk-icon-exclamation"></i> Nenhuma missão encontrada', 'status' => 'danger', 'timeout' => 0],
            ]);

            return redirect('/game');
        }
    }
}
