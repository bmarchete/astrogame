<?php

namespace App\Http\Controllers;

use App\Insignas;
use App\Item;
use App\Quest;
use App\User;
use Illuminate\Http\Request;
use DB;
use Share;

// toda a magia vai acontecer aqui :)
class GameController extends Controller
{

    public function campaing_map()
    {
        return view('game.general.map');
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
              // return view('game.general.player-privade');
        }

        // ranking - não sei qual bruxaria faz essa query aqui, mas funciona
        $ranking = User::selectRaw(DB::raw('FIND_IN_SET( xp, (SELECT GROUP_CONCAT( xp ORDER BY xp DESC ) FROM users )) AS rank'))
                        ->where('id', $user->id)->first();

        return view('game.general.player-public', ['player' => $user,
                                                   'player_patente' => User::patente($user->level),
                                                   'player_rank' => $ranking->rank,
                                                   'social' => (object) Share::load(url()->current(), 'Veja meu perfil no astrogame', url('/img/avatar.png'))->services('facebook', 'gplus', 'twitter', 'tumblr', 'pinterest')]);
    }
}
