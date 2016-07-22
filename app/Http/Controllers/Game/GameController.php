<?php

namespace App\Http\Controllers;

use App\Insignas;
use App\Item;
use App\Quest;
use App\User;
use App\UserBag;
use App\UserConfig;
use App\UserObservatory;
use Illuminate\Http\Request;
use DB;

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
        $players           = ['players' => User::select(DB::raw('@row:=@row+1 as row'), 'id', 'name', 'level', 'xp', 'money')->limit(50)->orderBy('xp', 'DESC')->get()];
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
        $user = User::where('id', $request->id)->limit(1)->first();

        // checagens
        if (!$user) {
            return 'Esse player não existe';
        }

        foreach($user->config as $config){
            if($config->key == 'private'){
                if($config->value == true){
                    return abort(404, 'Usuário privado');
                }
            }
        }

        $this->view_vars[] = ['player' => $user];
        $this->view_vars[] = ['player_patente' => User::patente($user->level)];

        return view('game.general.player-public', $this->view_vars());
    }

    protected function player_bar()
    {
        $planet = new UserObservatory();
        $planet->get_users_planetarium();
        $this->view_vars[] = [
            'music_volume'      => UserConfig::getConfig('music_volume'),
            'effects_volume'    => UserConfig::getConfig('effects_volume'),
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
        ];
    }
}
