<?php

namespace App\Http\Middleware;

use Closure;
use App\UserConfig;
use App\UserObservatory;
use App\UserProgres;
use App\Quest;
use App\UserBag;
use App\Insignas;
use App\User;
use App\Item;
use Cache;

class SetGameVars
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // game vars
        if(auth()->check()){
            $planet = new UserObservatory(); // melhor isso daqui
            $planet->get_users_planetarium();

            $telescopios = Cache::rememberForever('telescopios', function(){
                return Item::where('name', 'LIKE', '%Telescópio%')->orWhere('name', 'LIKE', '%Luneta%')->get();
            });

            $livros = Cache::rememberForever('livros', function(){
                return Item::where('name', 'LIKE', '%Telescópio%')->orWhere('name', 'LIKE', '%Guia%')->get();
            });

            $shop = ['telescopios' => $telescopios, 'livros' => $livros, 'insignas' => []];

            view()->composer('game.general.general', function ($view) use ($planet, $shop) {
                  $view->with('user_name', auth()->user()->nickname)
                       ->with('user_level', auth()->user()->level)
                       ->with('user_money', auth()->user()->money)
                       ->with('user_xp', auth()->user()->xp)
                       ->with('music_volume', auth()->user()->getConfig('music_volume'))
                       ->with('effects_volume', auth()->user()->getConfig('effects_volume'))
                       ->with('profile_private', auth()->user()->getConfig('private'))
                       ->with('tutorial', auth()->user()->getConfig('tutorial'))
                       ->with('xp_bar', auth()->user()->xp_bar())
                       ->with('xp_for_next_level', auth()->user()->xp_for_next_level())
                       ->with('lang', session()->get('language', 'pt-br'))
                       ->with('shop', $shop) // alterar isso daqui
                       ->with('bag', UserBag::bag())
                       ->with('avaliable_quests', Quest::avaliable_quests())
                       ->with('accepted_quests', Quest::accepted_quests())
                       ->with('user_insignas', Insignas::all())
                       ->with('planetarium', $planet->planetarium)
                       ->with('progress', new UserProgres);
            });
        }

        return $next($request);
    }
}
