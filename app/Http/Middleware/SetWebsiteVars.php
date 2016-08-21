<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Cache;

class SetWebsiteVars
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
        if ($request->route() != null && ($request->route()->uri() != null && $request->route()->uri() != '/')) {
            $uri = $request->route()->uri();
        } else {
            $uri = 'home';
        }

        view()->composer('project.general', function ($view) use ($uri) {
            $view->with('page', $uri);
        });

        if($uri == 'ranking'){
            $this->getOnlineUsersCount();
        }

        return $next($request);
    }

    private function getOnlineUsersCount()
    {
      view()->composer('project.ranking', function ($view) {
              $users = User::select('id')->where('online', 1)->get();
              $onlineUsersCount = 0;

              foreach ($users as $user) {
                  if (Cache::has('user-is-online-'.$user->id)) {
                      ++$onlineUsersCount;
                  }
              }

              $view->with(['onlineUsers' => $onlineUsersCount]);
      });
    }
}
