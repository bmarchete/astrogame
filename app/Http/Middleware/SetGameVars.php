<?php

namespace App\Http\Middleware;

use Closure;
use App\UserConfig;
use App\UserObservatory;
use App\Quest;
use App\Insignas;
use App\User;
use App\Item;
use Cache;
use DB;

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

            $insignas = $this->insignas();
            $shop = $this->shop_items();
            $ranking = $this->ranking();

            view()->composer('game.general.general', function ($view) use ($planet, $insignas, $shop, $ranking) {
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
                       ->with('all_insignas', $insignas)
                       ->with('ranking', $ranking)
                       ->with('shop', $shop)
                       ->with('avaliable_quests', Quest::avaliable_quests())
                       ->with('accepted_quests', Quest::accepted_quests())
                       ->with('planetarium', $planet->planetarium);
            });
        }

        return $next($request);
    }

    public function shop_items(){
        $telescopios = Cache::rememberForever('telescopios', function(){
            return Item::where('name', 'LIKE', '%Telescópio%')->orWhere('name', 'LIKE', '%Luneta%')->get();
        });

        $livros = Cache::rememberForever('livros', function(){
            return Item::where('name', 'LIKE', '%Telescópio%')->orWhere('name', 'LIKE', '%Guia%')->get();
        });

        return ['telescopios' => $telescopios, 'livros' => $livros, 'insignas' => []];
    }

    public function ranking(){
        return Cache::remember('ranking', 5, function(){
            DB::statement(DB::raw('set @row:=0'));
            return User::select(DB::raw('@row:=@row+1 as row'), 'id', 'name', 'level', 'xp', 'nickname')
                      ->whereHas('config', function ($q) {
                          $q->where('key', 'private')->where('content', false);
                      })->limit(100)->orderBy('xp', 'DESC')->get();
        });
    }

    public function insignas(){
        return Cache::rememberForever('insignas', function(){
          return Insignas::all();
        });
    }
}
