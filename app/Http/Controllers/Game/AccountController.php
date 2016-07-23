<?php

namespace App\Http\Controllers;

use App\User;
use App\UserConfig;
use Hash;
use Illuminate\Http\Request;
use Input;

class AccountController extends GameController
{
    public $ext_avaliables = ['png', 'jpg', 'jpge', 'gif'];

    public function change_volume_music(Request $request)
    {
        $volume = $request->volume;
        if ($volume > 100 || $volume < 0) {
            return 'Não é possível fazer isso';
        }
        UserConfig::setConfig('music_volume', $volume);
    }

    public function change_volume_effects(Request $request)
    {
        $volume = $request->volume;
        if ($volume > 100 || $volume < 0) {
            return 'Não é possível fazer isso';
        }
        UserConfig::setConfig('effects_volume', $volume);
    }

    public function change_profile(Request $request){
        if($request->type == 'public'){
            UserConfig::setConfig('private', false);
        } else if($request->type == 'private'){
            UserConfig::setConfig('private', true);
        }
    }

    public function change_account(Request $request)
    {
        // falta um validator
        $messages = [];

        $name         = $request->name;
        $email        = $request->email;
        $nickname     = $request->nickname;
        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $avatar       = $request->avatar;

        // mudou nome?
        if ($name != '' && auth()->user()->name != $name) {
            auth()->user()->name = $name;
            auth()->user()->save();
            $messages[] = ['status' => true, 'text' => 'Nome alterado'];
        }

        // mudou nickname?
        if ($nickname != '' && auth()->user()->nickname != $nickname) {
            if(User::select('id')->where('nickname', $nickname)->limit(1)->first()){
                $messages[] = ['status' => false, 'text' => 'Nickname já utilizado no sistema'];
            } else {
                auth()->user()->nickname = $nickname;
                auth()->user()->save();
                $messages[] = ['status' => true, 'text' => 'Nickname alterado'];
            }
        }

        // mudou email?
        if ($email != '' && $email != auth()->user()->email) {
            if(User::select('id')->where('email', $email)->limit(1)->first()){
                $messages[] = ['status' => false, 'text' => 'Email já utilizado no sistema'];
            } else {
                auth()->user()->email = $email;
                auth()->user()->save();
                $messages[] = ['status' => true, 'text' => 'Email alterado'];
            }
        }

        // mudou a senha?
        if ($old_password != '' && $new_password != '') {
            if (Hash::check($old_password, auth()->user()->password)) {
                auth()->user()->password = Hash::make($new_password);
                $messages[] = ['status' => true, 'text' => 'Senha alterada'];
            } else {
                $messages[] = ['status' => false, 'text' => 'Senha antiga inválida'];
            }
        }

        // mudou o avatar?
        if($request->hasFile('avatar')){
            if(in_array(strtolower($avatar->getClientOriginalExtension()), $this->ext_avaliables)){
                auth()->user()->makeAvatar(Input::file('avatar'));
                $messages[] = ['status' => true, 'text' => 'Avatar alterado com sucesso', 'avatar' => true];
            } else {
                $messages[] = ['status' => false, 'text' => 'A foto deve ser em jpg, png, gif ou jpge'];
            }
        }


        return response()->json($messages);
    }
}
