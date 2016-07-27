<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UsersQuest;
use App\Quest;

class QuestController extends GameController
{
    // quests
    public function quest_accept(Request $request)
    {
        $quest_id   = $request->id;
        $quest_user = new UsersQuest();
        $quest_user->quest($quest_id);
        $status = ($quest_user->accept_quest()) ? true : false;

        return response()->json(['accepted' => $status]);
    }

    public function quest_cancel(Request $request)
    {
        $quest_id   = $request->id;
        $quest_user = new UsersQuest();
        $quest_user->quest($quest_id);
        $status = ($quest_user->cancel_quest()) ? true : false;

        return response()->json(['canceled' => $status]);
    }

    public function quest_complete(Request $request){
        $quest_id = $request->id;

        $quest_user = new UsersQuest();
        $quest_user->quest($quest_id);
        if($quest_user->complete_quest()){
        session()->put('notify',
            [
                ['text' => '<i class="uk-icon-exclamation"></i> Missão: ' . $quest_user->quest_info->title . ' completada', 'status' => 'success'],
                ['text' => '<i class="uk-icon-money"></i> Ganho: ' . $quest_user->quest_info->money_reward . ' de dinheiro', 'status' => 'success'],
                ['text' => '<i class="uk-icon-exclamation"></i> Ganho: ' . $quest_user->quest_info->xp_reward . ' de XP ', 'status' => 'success'],

            ]);
          }

        return redirect('/game');
    }

    // ========================================
    // quests
    public function quest(Request $request)
    {
        $quest_id = $request->id;
        if($quest_id == 2){
            return $this->quest_palido_ponto_azul();
        }

        if($quest_id == 3){
            return $this->quest_cosmos_quizz();
        }

        return abort(404, 'Nenhuma quest encontrada');
    }

    public function quest_palido_ponto_azul()
    {
        return view('game.quests.ponto_azul');
    }

    public function quest_cosmos_quizz(){
        return view('game.quests.cosmos_quizz');
    }
}
