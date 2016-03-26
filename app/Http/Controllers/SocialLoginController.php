<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Socialize;
use App\User;
use App\UserConfig;
use Image;

class SocialLoginController extends Controller
{
    private $avalible_providers = ['facebook'];

	/**
     * Função apenas para acionar a route de login
     *
     * @param object Request | usado para pegar qual provider vai utilizar
     * @return void
     */
	public function login(Request $request) {
        if(in_array($request->provider, $this->avalible_providers)){
            return Socialize::with($request->provider)->redirect();
        } else {
            exit('Provedor de login não suportado');
        }		
    }

    // genérica para os dois
    public function fallback(Request $request){
        $provider = $request->provider;
        if($provider == 'facebook'){
            $user = Socialize::with('facebook')->user();
            
            $check_user = User::where('provider_user_id', $user->id)->where('provider_id', 1)->limit(1)->get()->first();
            if($check_user){
                // array diff para checar se o usuário mudou algo

                Auth::login($check_user);
                return redirect('/game');
            }

            $check_user_email = User::where('email', $user->email)->limit(1)->get()->first();
            if(empty($check_user) && $check_user_email){
                return redirect('/login')->with('social_error', 'Você já se cadastrou com esse email do facebook :(');
            }

            $user_db = new User;
            $user_db->name = $user->name;
            $user_db->email = $user->email;
            $user_db->nickname = $user->nickname;
            $user_db->provider_id = 1;
            $user_db->provider_user_id = $user->id;
            $user_db->gender = ($user->user['gender'] == 'male') ? 1 : 2;
            $user_db->password = bcrypt('temp' . rand() . 'temp');
            $user_db->save();

            $this->make_avatar($user->id, $user->avatar);
            
            Auth::login($user_db, true);
            UserConfig::installConfig($user_db->id);
            return redirect('/game');

        }
    }


    // @BUGGED
    public function make_avatar($user_id, $avatar_url) {
        $path = 'users/avatar/' . md5($user_id) . '.jpg';
        //$test = Image::make($avatar_url)->fit(200, 200)->save($path);
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
