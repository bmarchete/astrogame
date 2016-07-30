<?php

namespace App\Http\Middleware;

use Closure;

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

        return $next($request);
    }
}
