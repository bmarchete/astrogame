<?php

namespace AstroGame\Http\Controllers;

use Illuminate\Http\Request;
use AstroGame\Http\Requests;
use AstroGame\UserConfig;

class AccountController extends GameController
{
    public function change_volume_music(Request $request){
        $volume = $request->volume;
        if($volume > 100 || $volume < 0){
            return "Não é possível fazer isso";
        }
        UserConfig::setConfig('music_volume', $volume);
    }
}
