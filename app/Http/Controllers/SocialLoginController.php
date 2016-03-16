<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Socialize;

class SocialLoginController extends Controller
{

	/**
     * Função apenas para acionar a route de login
     *
     * @param object Request | usado para pegar qual provider vai utilizar
     * @return void
     */
	public function login(Request $request) {
		switch($request->provider){
			case 'google':
				$provider = 2;
			default: // facebook
				$provider = 1;
		}
		
		return Socialize::with($provider)->redirect();
    }

    // genérica para os dois
    public function fallback(Request $request){
    	$request->provider;
    }

	/**
     * Função que é acionada quando o facebook valida e volta a requisição de login
     *
     * @return void
     */
    public function facebook_fallback() {

    }

    /**
     * Função que é acionada quando o google valida e volta a requisição de login
     *
     * @return void
     */
    public function google_fallback() {

    }
}
