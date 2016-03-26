<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Auth;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * função que checa se o usuário passou de level, se sim notifica ele
     * deve ser chamada toda vez depois de gainXP()
     *
     * @return void
     */
    protected static function checkLevel(){

    }

    /**
     * Função para aumentar pontos de xp do jogador
     *
     * @param int xp
     * @return void
     */
    public static function gain_xp($xp){
        $user_id = Auth::user()->id; // talvez trocar para (getAuthIdentifier())
        DB::table('users')->where('id', $user_id)->increment('xp');
        Auth::user()->xp += $xp;
        self::checkLevel();
    } // testar

    public static function xp_bar(){
        // pega o xp e transforma em porcentagem
        $user_xp = Auth::user()->xp;
        return 80;
    }


    // @return string
    public static function patente(){
        // (1-3)  -> Observador 
        // (3-6)  -> Vigia das estrelas
        // (6-9)  -> Residente (?)
        // (9-10) -> Chefe de Laboratorio 
        // (10-11)-> Ciêntista 
        // (12)   -> Astronauta - Amador
        // (13)   -> Astronauta - Pesquisador
        // (14)   -> Astronauta - Líder de Módulo
        // (15)   -> Astronauta - Chefe de estação
        if(auth()->user()->type == 3){
            return trans('game.patent-gm');
        }

        $level = auth()->user()->level;
        
        if($level < 3){
            return trans('game.patent1');
        } else if($level >= 3 && $level < 6){
            return trans('game.patent2');
        } else if($level >= 6 && $level < 9){
            return trans('game.patent3');
        } else if($level >= 9 && $level < 10){
            return trans('game.patent4');
        } else if($level >= 10 && $level <= 11){
            return trans('game.patent5');
        } else if($level == 12){
            return trans('game.patent6');
        } else if($level == 13){
            return trans('game.patent7');
        } else if($level == 14){
            return trans('game.patent8');
        } else if($level > 15){
            return trans('game.patent9');
        }
    }
}
