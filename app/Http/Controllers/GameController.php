<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use User;
use App\UserConfig;
use App\UsersQuest;

// toda a magia vai acontecer aqui :)
class GameController extends Controller
{

	/**
     * Página inicial do jogo
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
    	return $this->tutorial();
    }	

    public function tutorial() {
    	return view('game.chapters.tutorial');
    }

    public function observatory() {
    	return view('game.general.observatory');
    }

    // quests
    public function quest_accept(Request $request){
        $quest_id = $request->id;
        $status = (UsersQuest::accept_quest($quest_id)) ? true : false;

        return response()->json(['accepted' => $status]);
    }

    public function quest_cancel(Request $request){
        $quest_id = $request->id;
        $status = (UsersQuest::cancel_quest($quest_id)) ? true : false;

        return response()->json(['canceled' => $status]);
    }

    public function change_volume_music(Request $request){
        $volume = $request->volume;
        if($volume > 100 || $volume < 0){
            return "Não é possível fazer isso";
        }
        UserConfig::setConfig('music_volume', $volume);
    }
}
