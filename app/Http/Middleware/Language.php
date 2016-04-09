<?php

namespace AstroGame\Http\Middleware;

use Closure;
use App;

class Language
{
    public $avaliable_langs = ['pt-br' => 'pt-br',
                               'pt' => 'pt-br', 
                               'en' => 'en', 
                               'en-US' => 'en',
                               'fr' => 'fr', 
                               'es' => 'es'];
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
        $language = session()->get('language', $this->browser_lang());
        App::setLocale($language);
        return $next($request);
    }

    private function browser_lang(){
        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        if(array_key_exists($lang, $this->avaliable_langs)){
            return $this->avaliable_langs[$lang];
        } else {
            return 'en';
        }
    }
}
