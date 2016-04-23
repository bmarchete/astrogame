<?php

namespace AstroGame\Http\Middleware;

use Closure;

class HttpsProtocol {

    public function handle($request, Closure $next)
    {
	    $request->setTrustedProxies( [ $request->getClientIp() ] ); 
	
        if (!$request->secure() /* && ($_SERVER['HTTP_HOST'] != "astrogame.localhost") */) {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request); 
    }
}
