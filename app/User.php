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
    public static function gainXP($xp){
        $user_id = Auth::user()->id; // talvez trocar para (getAuthIdentifier())
        DB::table('users')->where('id', $user_id)->increment('xp');
        Auth::user()->xp += $xp;
        self::checkLevel();
    } // testar
}
