<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\UserConfig;
use App\UsersQuest;
use App\UserBag;
use App\Item;
use App\Quest;
use App\UserProgres;
use App\UserInsignas;

// toda a magia vai acontecer aqui :)
class GameController extends Controller
{

    private $view_vars = [];

    public function __construct() {
        if(auth()->check()){
            $this->player_bar();
        }
    }

    private function view_vars(){
        foreach($this->view_vars as $array_level1){
            foreach($array_level1 as $key => $value){
                $final[$key] = $value; 
            }
        }
        return $final;
    }

    /**
     * Página inicial do jogo
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {     
        $current_chapter = new UserProgres();
        $name = $current_chapter->current()->name;

        return $this->$name();
    }   

    public function tutorial() {
        $chapter = new UserProgres;
        $chapter->key = 'welcome';
        $complete = $chapter->complete();

        return view('game.chapters.tutorial', $this->view_vars());
    }

    public function welcome() {
        return view('game.chapters.welcome', $this->view_vars());
    }

    public function observatory() {
        return view('game.general.observatory', $this->view_vars());
    }

    public function ranking() {
        $players = ['players' => User::select('id', 'name', 'level', 'xp', 'money')->limit(5)->orderBy('xp', 'DESC')->get()];
        $this->view_vars[] = $players;

        return view('game.general.ranking', $this->view_vars());
    }

    public function player(Request $request){
        $user_id = $request->id;
        $check_user = User::where('id', $user_id)->limit(1)->get()->first();
        if(!$check_user){
            return "Esse player não existe";
        }
        $this->view_vars[] = ['player' => $check_user];
        $this->view_vars[] = ['player_patente' => User::patente($check_user->level)];

        return view('game.general.player-public', $this->view_vars());
    }

    public function player_bar() {
        $this->view_vars[] = [
            'music_volume' => UserConfig::getConfig('music_volume'),
            'xp_bar' => User::xp_bar(),
            'user_name' => auth()->user()->name,
            'user_level' => auth()->user()->level,
            'user_money' => auth()->user()->money,
            'user_xp' => auth()->user()->xp,
            'xp_for_next_level' => User::xp_for_next_level(),
            'lang' => session()->get('language', 'pt-br'),
            'shop' => Item::shop(),
            'bag' => UserBag::bag(),
            'avaliable_quests' => Quest::avaliable_quests(),
            'accepted_quests' => Quest::accepted_quests(),
            'patente' => User::patente(),
            'user_insignas' => \App\Insignas::all(),
        ];
    }

    // chapters
    public function chapter1() { 
        return view('game.chapters.universe', $this->view_vars());

    } // the universe
    public function chapter2() { } // galaxy clusters
    public function chapter3() { } // galaxies


    public function chapter_complete(Request $request) {
        // alguma checagem para não ter espertinhos
        $key = $request->key;

        $chapter = new UserProgres;
        $chapter->key = $key;
        $complete = $chapter->complete();
        
        return response()->json($complete);
    }

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
