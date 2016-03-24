<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use User;
use App\UserConfig;
use App\UsersQuest;
use App\UserBag;
use App\Item;

// toda a magia vai acontecer aqui :)
class GameController extends Controller
{

    /**
     * Página inicial do jogo
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return $this->chapter1();
    }   

    public function tutorial() {
        return view('game.chapters.tutorial');
    }

    public function observatory() {
        return view('game.general.observatory');
    }

    // chapters
    public function chapter1() { 
        // min level = 1
        // max level = null
        // xp on complete = 1500
        // skills = ??
        // personagem = ?? (Carl Sagan)
        // quizz final (ID 1)

        return view('game.chapters.universe');
        


    } // the universe
    public function chapter2() { } // galaxy clusters
    public function chapter3() { } // galaxies

    // quests
    public function quest_accept(Request $request){
        $quest_id = $request->id;
        $quest_user = new UsersQuest();
        $quest_user->quest($quest_id);
        $status = ($quest_user->accept_quest()) ? true : false;

        return response()->json(['accepted' => $status]);
    }

    public function quest_cancel(Request $request){
        $quest_id = $request->id;
        $quest_user = new UsersQuest();
        $quest_user->quest($quest_id);
        $status = ($quest_user->cancel_quest()) ? true : false;

        return response()->json(['canceled' => $status]);
    }

    // items
    public function buy_item(Request $request){
        $item_id = $request->id;
        $item_return = Item::buy_item($item_id);

        return response()->json($item_return);
    }

    public function remove_item(Request $request){
        $item_id = $request->id;
        $item_return = UserBag::remove_item_from_bag($item_id, 1);

        return response()->json(['status' => true, 'msg' => 'Item removido!']);
    }

    public function change_volume_music(Request $request){
        $volume = $request->volume;
        if($volume > 100 || $volume < 0){
            return "Não é possível fazer isso";
        }
        UserConfig::setConfig('music_volume', $volume);
    }
}
