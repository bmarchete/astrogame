<?php

namespace App\Http\Middleware;

use Closure;
use App;

class Language
{
    /**
     * Handle an incoming request.
     * Checa se há uma linguagem settada na sessão, se sim, muda a lang
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $language = session()->get('language', 'pt-br');
        App::setLocale($language);
        return $next($request);
    }
}
