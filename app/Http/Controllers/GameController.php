<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use User;
use App\UserConfig;
use App\UsersQuest;
use App\UserBag;
use App\Item;
use Session;
use App\Quest;
use Auth;
use App\UserProgres;

// toda a magia vai acontecer aqui :)
class GameController extends Controller
{

    private $view_vars = [];

    /**
     * Página inicial do jogo
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return $this->chapter1();
    }   

    public function tutorial() {
        return view('game.chapters.tutorial', $this->player_bar());
    }

    public function observatory() {
        return view('game.general.observatory', $this->player_bar());
    }

    public function player_bar() {
        return [
            'music_volume' => UserConfig::getConfig('music_volume'),
            'xp_bar' => \App\User::xp_bar(),
            'user_name' => Auth::user()->name,
            'user_level' => Auth::user()->level,
            'user_money' => Auth::user()->money,
            'user_xp' => Auth::user()->xp,
            'lang' => Session::get('language', 'pt-br'),
            'shop' => Item::shop(),
            'bag' => UserBag::bag(),
            'avaliable_quests' => Quest::avaliable_quests(),
            'accepted_quests' => Quest::accepted_quests()
        ];
    }

    // chapters
    public function chapter1() { 
        // min level = 1
        // max level = null
        // xp on complete = 1500
        // skills = ??
        // personagem = ?? (Carl Sagan)
        // quizz final (ID 1)

        return view('game.chapters.universe', $this->player_bar());
        


    } // the universe
    public function chapter2() { } // galaxy clusters
    public function chapter3() { } // galaxies


    public function progress_on_chapter(Request $request) {
        // alguma checagem para não ter espertinhos

        $key = $request->key;

        $chapter_progress = new UserProgres;
        $chapter_progress->key = '';
        

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
