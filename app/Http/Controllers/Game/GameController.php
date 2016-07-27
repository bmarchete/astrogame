<?php

namespace App\Http\Controllers;

use App\Insignas;
use App\Item;
use App\Quest;
use App\User;
use App\UserBag;
use App\UserConfig;
use App\UserObservatory;
use App\UserProgres;
use Illuminate\Http\Request;
use DB;
use Share;

// toda a magia vai acontecer aqui :)
class GameController extends Controller
{

    protected $view_vars = [];

    public function __construct()
    {
        if (auth()->check()) {
            $this->player_bar();
        }
    }

    protected function view_vars()
    {
        foreach ($this->view_vars as $array_level1) {
            foreach ($array_level1 as $key => $value) {
                $final[$key] = $value;
            }
        }
        return $final;
    }

    public function campaing_map()
    {
        return view('game.general.map', $this->view_vars());
    }

    public function ranking()
    {
        DB::statement(DB::raw('set @row:=0'));

        $players = User::select(DB::raw('@row:=@row+1 as row'), 'id', 'name', 'level', 'xp', 'money')
                  ->whereHas('config', function ($q) {
                      $q->where('key', 'private')->where('content', false);
                  })->limit(50)->orderBy('xp', 'DESC')->get();

        $players           = ['players' => $players];
        $this->view_vars[] = ['page' => 'ranking'];
        $this->view_vars[] = $players;

        return view('project.ranking', $this->view_vars());
    }

    public function shop()
    {
        $telescopios = Item::where('name', 'LIKE', '%Telescópio%')->orWhere('name', 'LIKE', '%Luneta%')->get();
        $livros      = Item::where('name', 'LIKE', '%Livro%')->orWhere('name', 'LIKE', '%Guia%')->get();
        $insignas    = [];

        return ['telescopios' => $telescopios, 'livros' => $livros, 'insignas' => $insignas];
    }

    // player public profile
    public function player(Request $request)
    {
        $user = null;
        // primeiro checa se não é o próprio usuário
        if(auth()->check()){
            if($request->id == auth()->user()->id){
                $user = auth()->user();
            }
        }

        // se ainda não achou nenhum usuário procura e verifica se não é privado
        if($user == null){
          $user = User::where('id', $request->id)->whereHas('config', function ($q) {
              $q->where('key', 'private')->where('content', false);
          })->first();
        }

        // checagens
        if (!$user) {
              return "usuário não existe ou é privado";
              // return view('game.general.player-privade', $this->view_vars());
        }

        // ranking - não sei qual bruxaria faz essa query aqui, mas funciona
        $ranking = User::selectRaw(DB::raw('FIND_IN_SET( xp, (SELECT GROUP_CONCAT( xp ORDER BY xp DESC ) FROM users )) AS rank'))
                        ->where('id', $user->id)->first();

        $this->view_vars[] = ['player' => $user];
        $this->view_vars[] = ['player_patente' => User::patente($user->level)];
        $this->view_vars[] = ['player_rank' => $ranking->rank];
        $this->view_vars[] = ['social' => (object) Share::load(url()->current(), 'Veja meu perfil no astrogame', url('/img/avatar.png'))->services('facebook', 'gplus', 'twitter', 'tumblr', 'pinterest')];

        return view('game.general.player-public', $this->view_vars());
    }

    protected function player_bar()
    {
        $planet = new UserObservatory();
        $planet->get_users_planetarium();
        $progress = new UserProgres();

        $this->view_vars[] = [
            'music_volume'      => UserConfig::getConfig('music_volume', auth()->user()),
            'effects_volume'    => UserConfig::getConfig('effects_volume', auth()->user()),
            'xp_bar'            => auth()->user()->xp_bar(),
            'user_name'         => auth()->user()->nickname,
            'user_level'        => auth()->user()->level,
            'user_money'        => auth()->user()->money,
            'user_xp'           => auth()->user()->xp,
            'xp_for_next_level' => auth()->user()->xp_for_next_level(),
            'lang'              => session()->get('language', 'pt-br'),
            'shop'              => $this->shop(),
            'bag'               => UserBag::bag(),
            'avaliable_quests'  => Quest::avaliable_quests(),
            'accepted_quests'   => Quest::accepted_quests(),
            'patente'           => User::patente(),
            'user_insignas'     => Insignas::all(),
            'planetarium'       => $planet->planetarium,
            'progress'          => $progress,
        ];
    }
}
