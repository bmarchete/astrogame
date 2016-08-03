<?php

namespace App\Http\Middleware;

use Closure;
use App\UserConfig;
use App\UserObservatory;
use App\UserProgres;
use App\Quest;
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
            $chapter = new UserProgres;

            view()->composer('game.general.general', function ($view) use ($planet, $shop, $chapter) {
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
                       ->with('bag', auth()->user()->bag())
                       ->with('user_insignas', auth()->user()->insignas)
                       ->with('shop', $shop) // alterar isso daqui
                       ->with('avaliable_quests', Quest::avaliable_quests())
                       ->with('accepted_quests', Quest::accepted_quests())
                       ->with('planetarium', $planet->planetarium)
                       ->with('progress', $chapter)
                       ->with('chapter_current', $chapter->current()->name);
            });
        }

        return $next($request);
    }

    public function shop_items(){

    }
}
