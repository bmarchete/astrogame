<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    // ========================================
    // quests
    public function quest(Request $request)
    {
        $quest_id = $request->id;
        switch ($quest_id) {
            case 1:
                return $this->quest_stars();
                break;

            default:
                return view("Nenhuma quest encontrada");
                break;
        }
    }

    public function quest_stars()
    {
        return view('game.quests.quest_1', $this->view_vars());
    }
}
