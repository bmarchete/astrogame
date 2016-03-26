<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class UserConfig extends Model
{
	public $timestamps = false;
	public static $default = [
    	'music_volume' => 100,
    	'effects_volume' => 100,
    	'lang' => 'pt-br',
    	];

    public static function getConfig($config_key){
    	if(!auth()->check()){
    		return false;
    	}
    	$user_id = auth()->user()->id;
    	$config = UserConfig::select('content')->where('user_id', $user_id)->where('key', $config_key)->limit(1)->get()->first();
    	return $config->content;
    }

    public static function setConfig($config_key, $content){
    	if(!auth()->check()){
    		return false;
    	}
    	$user_id = auth()->user()->id;
    	DB::table('user_configs')
            ->where('user_id', $user_id)
            ->where('key', $config_key)
            ->update(['content' => $content]);
    }    

    public static function installConfig($user_id = 0){
        if($user_id != 0){
            if(auth()->check()){
                $user_id = auth()->user()->id;
            }
        }

    	foreach(self::$default as $key => $content){
    		$config = new UserConfig;
    		$config->key = $key;
    		$config->content = $content;
    		$config->user_id = $user_id;
    		$config->save();
    	}
    }
}
