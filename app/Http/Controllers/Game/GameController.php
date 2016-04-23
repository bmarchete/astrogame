<?php

namespace AstroGame\Http\Controllers;

use Illuminate\Http\Request;

use AstroGame\Http\Requests;
use AstroGame\User;
use AstroGame\UserConfig;
use AstroGame\UsersQuest;
use AstroGame\UserBag;
use AstroGame\Item;
use AstroGame\Quest;
use AstroGame\UserProgres;
use AstroGame\UserInsignas;
use AstroGame\Insignas;
use AstroGame\UserObservatory;

// toda a magia vai acontecer aqui :)
class GameController extends Controller
{

    protected $view_vars = [];

    public function __construct() {
        if(auth()->check()){
            $this->player_bar();
        }
    }

    protected function view_vars(){
        foreach($this->view_vars as $array_level1){
            foreach($array_level1 as $key => $value){
                $final[$key] = $value; 
            }
        }
        return $final;
    }


    public function campaing_map() {
        return view('game.general.map', $this->view_vars());
    }

    public function ranking() {
        $players = ['players' => User::select('id', 'name', 'level', 'xp', 'money')->limit(5)->orderBy('xp', 'DESC')->get()];
        $this->view_vars[] = $players;

        return view('game.general.ranking', $this->view_vars());
    }

    public function shop() {
        $telescopios = Item::where('name', 'LIKE', '%Telescópio%')->orWhere('name', 'LIKE', '%Luneta%')->get();
        $livros = Item::where('name', 'LIKE', '%Livro%')->orWhere('name', 'LIKE', '%Guia%')->get();
        $insignas = [];

        return ['telescopios' => $telescopios, 'livros' => $livros, 'insignas' => $insignas];
    }

    // player public profile
    public function player(Request $request){
        $user_id = $request->id;
        $check_user = User::where('id', $user_id)->limit(1)->get()->first();
        if(!$check_user){
            return 'Esse player não existe';
        }
        $this->view_vars[] = ['player' => $check_user];
        $this->view_vars[] = ['player_patente' => User::patente($check_user->level)];

        return view('game.general.player-public', $this->view_vars());
    }

    protected function player_bar() {
        $this->view_vars[] = [
            'music_volume' => UserConfig::getConfig('music_volume'),
            'xp_bar' => User::xp_bar(),
            'user_name' => auth()->user()->name,
            'user_level' => auth()->user()->level,
            'user_money' => auth()->user()->money,
            'user_xp' => auth()->user()->xp,
            'xp_for_next_level' => User::xp_for_next_level(),
            'lang' => session()->get('language', 'pt-br'),
            'shop' => $this->shop(),
            'bag' => UserBag::bag(),
            'avaliable_quests' => Quest::avaliable_quests(),
            'accepted_quests' => Quest::accepted_quests(),
            'patente' => User::patente(),
            'user_insignas' => Insignas::all(),
        ];
    }   
}