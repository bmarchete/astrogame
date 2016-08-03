<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class UserConfig extends Model
{
    public $timestamps = false;

    public static $default = [
        'music_volume'   => 50,
        'effects_volume' => 50,
        'lang'           => 'pt-br',
        'private'        => false,
        'tutorial'       => true,
    ];

    public static function getConfig($config_key, User $user)
    {
        $config = UserConfig::select('content')->where('user_id', $user->id)->where('key', $config_key)->limit(1)->first();
        if($config){
          return $config->content;
        } else {
          return false;
        }
    }

    public static function setConfig($config_key, $content)
    {
        if (!auth()->check()) {
            return false;
        }
        DB::table('user_configs')->where('user_id', auth()->user()->id)
            ->where('key', $config_key)
            ->limit(1)
            ->update(['content' => $content]);
    }

    public static function installConfig($user_id = 0)
    {
        if ($user_id != 0) {
            if (auth()->check()) {
                $user_id = auth()->user()->id;
            }
        }

        foreach (self::$default as $key => $content) {
            /* if($key == 'lang'){
            if(empty(session()->get('language'))){
            $content = 'pt-br';
            }
            $content = session()->get('language');
            } */
            $config          = new UserConfig;
            $config->key     = $key;
            $config->content = $content;
            $config->user_id = $user_id;
            $config->save();
        }
    }
}
