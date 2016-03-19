<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use User;
use App\UserConfig;

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

    public function change_volume_music(Request $request){
        $volume = $request->volume;
        if($volume > 100 || $volume < 0){
            return "Não é possível fazer isso";
        }
        UserConfig::setConfig('music_volume', $volume);
    }
}
