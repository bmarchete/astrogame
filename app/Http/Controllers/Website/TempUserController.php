<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;
use App\Models\Config;

class TempUserController extends Controller
{
    public $data = [
      'name' => 'Usuário teste',
      'email' => 'teste@teste.com',
      'nickname' => 'teste',
      'money' => 5000,
      'xp' => 300,
      'password' => 'drilindo220499',
    ];

    public function create_or_reset(){
        $user = User::where('id', 1)->first();
        if($user){
          $user->insignas()->delete();
          $user->history()->delete();
          $user->user_bag()->delete();
          $user->quest_log()->delete();
          $user->remove_avatar();
        } else {
          $user = new User();
        }

        $user->name = $this->data['name'];
        $user->nickname = $this->data['nickname'];
        $user->email = $this->data['email'];
        $user->xp = $this->data['xp'];
        $user->money = $this->data['money'];
        $user->password = bcrypt($this->data['password']);
        $user->save();

        return redirect('/expoete/login');
    }

    public function login(){
        auth()->attempt(['nickname'=> $this->data['nickname'], 'password' => $this->data['password']]);
        Config::setConfig('tutorial', true);
        Config::setConfig('private', true);
        Config::setConfig('music_volume', 50);
        Config::setConfig('effects_volume', 50);
        Config::setConfig('lang', 'pt-br');

        return redirect('/game');
    }
}
