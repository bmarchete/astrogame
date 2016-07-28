<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Socialize;

class SocialLoginController extends Controller
{
    private $avalible_providers = ['facebook', 'google'];
    private $redirect = '/game';

    // checa se pode utilizar
    public function __construct(Request $request)
    {
        if (!in_array($request->provider, $this->avalible_providers)) {
            abort(404, 'Provedor de login não suportado');
        }
    }

    /**
     * Função apenas para acionar a route de login.
     *
     * @param object Request | usado para pegar qual provider vai utilizar
     */
    public function login($provider)
    {
        return Socialize::with($provider)->redirect();
    }

    /**
     * Função que é acionada quando o facebook ou google valida e volta a requisição de login.
     */
    protected function fallback($provider)
    {
        $provider_id = ($provider == 'facebook') ? 1 : 2; // 2 = google
        $user = Socialize::with($provider)->user();

        $check_user = User::where('provider_user_id', $user->getId())->where('provider_id', $provider_id)->limit(1)->first();
        if ($check_user) {
            $this->check_diff($user, $check_user);

            auth()->login($check_user);

            return redirect($this->redirect);
        }

        $check_user_email = User::where('email', $user->getEmail())->limit(1)->first();
        if (empty($check_user) && $check_user_email) {
            $check_user_email->provider_id = $provider_id;
            $check_user_email->provider_user_id = $user->getId();
            $check_user_email->save();
            auth()->login($check_user_email);

            return redirect($this->redirect);
        }

        $user_db = new User();
        $user_db->name = $user->getName();
        $user_db->email = $user->getEmail();
        $user_db->nickname = $user->getNickname();
        $user_db->provider_id = $provider_id;
        $user_db->provider_user_id = $user->getId();
        $user_db->gender = ($user->user['gender'] == 'male') ? 1 : 2;
        $user_db->password = bcrypt('temp'.rand(1, 100000).'temp');
        $user_db->save();

        $user_db->makeAvatar($user->getAvatar());

        return redirect($this->redirect);
    }

    /**
     * Função diff para checar se o usuário mudou algo no provider, se sim moda no banco de dados.
     */
    protected function check_diff($provider, User $user)
    {
        $user_1 = [
            'name' => $provider->getName(),
            'email' => $provider->getEmail(),
            'gender' => ($provider->user['gender'] == 'male') ? 1 : 2,
          ];
        $user_2 = [
            'name' => $user->name,
            'email' => $user->email,
            'gender' => $user->gender,
          ];

        if (!empty(array_diff($user_1, $user_2))) {
            if (User::select('id')->where('email', $provider->getEmail())->first() == null) {
                $user->email = $provider->getEmail();
            }
            $user->name = $provider->getName();
            $user->gender = $provider->gender;
        }

        $user->makeAvatar($provider->getAvatar());
    }
}
