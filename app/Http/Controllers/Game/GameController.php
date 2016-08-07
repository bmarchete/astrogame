<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use DB;
use Share;

// toda a magia vai acontecer aqui :)
class GameController extends Controller
{
    public function index(){
        return view('game.chapters.welcome');
    }

    public function campaing_map()
    {
        return view('game.general.map');
    }

    // player public profile
    public function player(Request $request)
    {
        $user = null;
        // primeiro checa se não é o próprio usuário
        if (auth()->check()) {
            if ($request->nickname == auth()->user()->nickname) {
                $user = auth()->user();
            }
        }

        // se ainda não achou nenhum usuário procura e verifica se não é privado
        if ($user == null) {
            $user = User::where('nickname', $request->nickname)->whereHas('config', function ($q) {
              $q->where('key', 'private')->where('content', false);
          })->first();
        }

        // checagens
        if (!$user) {
            session()->put('notify',
                [
                    ['text' => '<i class="uk-icon-user-secret"></i> Esse usuário é privado', 'status' => 'danger', 'timeout' => 1000],
                ]);

            return redirect('/');
        }

        // ranking - não sei qual bruxaria faz essa query aqui, mas funciona
        $ranking = User::selectRaw(DB::raw('FIND_IN_SET( xp, (SELECT GROUP_CONCAT( xp ORDER BY xp DESC ) FROM users )) AS rank'))
                        ->where('nickname', $user->nickname)->first();

        return view('game.general.player-public', ['player' => $user,
                                                   'player_rank' => $ranking->rank,
                                                   'social' => (object) Share::load(url()->current(), 'Veja meu perfil no astrogame', url('/img/avatar.png'))->services('facebook', 'gplus', 'twitter', 'tumblr', 'pinterest'), ]);
    }
}
