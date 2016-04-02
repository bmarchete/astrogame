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
use App\Insignas;
use App\UserObservatory;

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
        $chapter_name = $current_chapter->current()->name;

        return $this->$chapter_name();
    }   

    public function observatory() {
        $observatory = new UserObservatory();
        $observatory->get_users_planetarium();
        $this->view_vars[] = ['planetarium' => $observatory->planetarium];

        return view('game.general.observatory', $this->view_vars());
    }

    public function exploration() {
        return view('game.general.exploration', $this->view_vars());
    }

    public function ranking() {
        $players = ['players' => User::select('id', 'name', 'level', 'xp', 'money')->limit(5)->orderBy('xp', 'DESC')->get()];
        $this->view_vars[] = $players;

        return view('game.general.ranking', $this->view_vars());
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
            'shop' => $this->shop(),
            'bag' => UserBag::bag(),
            'avaliable_quests' => Quest::avaliable_quests(),
            'accepted_quests' => Quest::accepted_quests(),
            'patente' => User::patente(),
            'user_insignas' => Insignas::all(),
        ];
    }

    public function shop() {
        $telescopios = Item::where('name', 'LIKE', '%Telescópio%')->get();
        $livros = Item::where('name', 'LIKE', '%Livro%')->get();
        $insignas = [];

        return ['telescopios' => $telescopios, 'livros' => $livros, 'insignas' => $insignas];
    }

    // =================================================
    // functions
    // =================================================
    public function chapter_complete(Request $request) {
        // alguma checagem aqui para não ter espertinhos
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

    // ========================================
    // chapters
    // order:
    // 1 - welcome (pre-tutorial)
    // 2 - tutorial
    // 3 - capítulo 1
    public function welcome() {
        return view('game.chapters.welcome', $this->view_vars());
    }

    public function tutorial() {
        $chapter = new UserProgres;
        $chapter->key = 'welcome';
        $complete = $chapter->complete()['completed'];
        if($complete){
            session()->put('notify', 

            [
            
            ['text' => '<i class="uk-icon-exclamation"> </i> Você ganhou 100 xp!',
             'status' => 'success'],
            ['text' => '<i class="uk-icon-exclamation"> </i> Parabéns, você acabou de completar as boas vindas!',
             'status' => 'success'],

            ]);
        } else {
            session()->forget('notify');
        }
        return view('game.chapters.tutorial', $this->view_vars());
    }

    public function chapter1() {
        $chapter = new UserProgres;
        $chapter->key = 'tutorial';
        $complete = $chapter->complete()['completed'];

        if($complete){
            session()->put('notify', 

            [
            
            ['text' => '<i class="uk-icon-exclamation"> </i> Você ganhou 200 xp!',
             'status' => 'success'],
            ['text' => '<i class="uk-icon-exclamation"> </i> Parabéns, você acabou de completar o tutorial básico!',
             'status' => 'success'],

            ]);
        } else {
            session()->forget('notify');
        }

        return view('game.chapters.chapter1', $this->view_vars());
    }

    
}
