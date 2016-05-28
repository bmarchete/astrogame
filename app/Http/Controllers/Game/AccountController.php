<?php

namespace App\Http\Controllers;

use App\User;
use App\UserConfig;
use Hash;
use Illuminate\Http\Request;

class AccountController extends GameController
{
    public function change_volume_music(Request $request)
    {
        $volume = $request->volume;
        if ($volume > 100 || $volume < 0) {
            return 'Não é possível fazer isso';
        }
        UserConfig::setConfig('music_volume', $volume);
    }

    public function change_account(Request $request)
    {
        $messages = [];

        $name         = $request->name;
        $email        = $request->email;
        $nickname     = $request->nickname;
        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $avatar       = ''; // ? todo

        // mudou nome?
        if (auth()->user()->name != $name) {
            auth()->user()->name = $name;
            auth()->user()->save();
            $messages[] = ['status' => true, 'text' => 'Nome alterado'];
        }

        // mudou nickname?
        if (auth()->user()->nickname != $nickname) {
            auth()->user()->nickname = $nickname;
            auth()->user()->save();
            $messages[] = ['status' => true, 'text' => 'nickname alterado'];
        }

        // mudou email?
        if ($email != auth()->user()->email) {
            auth()->user()->email = $email;
            auth()->user()->save();
            $messages[] = ['status' => true, 'text' => 'Email alterado'];
        }

        // mudou a senha?
        if ($old_password != '' && $new_password != '') {
            if (Hash::check($old_password, auth()->user()->password)) {
                auth()->user()->password = Hash::make($new_password);
                $messages[]              = ['status' => true, 'text' => 'Senha alterada'];
            } else {
                $messages[] = ['status' => false, 'text' => 'Senha antiga inválida'];
            }
        }

        return response()->json($messages);
    }
}
