<?php

namespace App;

use Carbon\Carbon;
use DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Image;
use Log;

class User extends Authenticatable
{

    public static $level_xp =
        [
        // level => xp_for_next_level
        1  => 400,
        2  => 900,
        3  => 1400,
        4  => 2100,
        5  => 2800,
        6  => 3600,
        7  => 4500,
        8  => 5400,
        9  => 6500,
        10 => 7600,
        11 => 8700,
        12 => 9800,
        13 => 11000,
        14 => 12300,
        15 => 13600,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'nickname', 'password', 'confirm_code',
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
    protected static function checkLevel()
    {

    }

    /**
     * Função para aumentar pontos de xp do jogador
     *  @TODO: REFACTOR
     * @param int xp
     * @return void
     */
    public static function gain_xp($xp)
    {
        DB::table('users')->where('id', auth()->user()->id)->increment('xp', $xp);
        auth()->user()->xp += $xp;
        if (auth()->user()->xp >= self::xp_for_next_level()) {
            auth()->user()->level += 1;
            DB::table('users')->where('id', auth()->user()->id)->increment('level');
        }
    }

    // pega o xp e transforma em porcentagem
    public static function xp_bar()
    {
        $porcent = (auth()->user()->xp * 100) / self::xp_for_next_level();
        return round($porcent);
    }

    public static function xp_for_next_level()
    {
        $counter = count(self::$level_xp);
        $max = $counter + 1;

        if( (auth()->user()->level + 1) >= $max){
            return self::$level_xp[$counter];
        } else {
            return self::$level_xp[auth()->user()->level + 1];
        }
    }

    // @return string
    public static function patente($user_level = 0)
    {
        // (1-3)  -> Observador
        // (3-6)  -> Vigia das estrelas
        // (6-9)  -> Residente (?)
        // (9-10) -> Chefe de Laboratorio
        // (10-11)-> Ciêntista
        // (12)   -> Astronauta - Amador
        // (13)   -> Astronauta - Pesquisador
        // (14)   -> Astronauta - Líder de Módulo
        // (15)   -> Astronauta - Chefe de estação
        if (auth()->check() && auth()->user()->type == 3) {
            return trans('game.patent-gm');
        }

        if (auth()->check() && $user_level == 0) {
            $level = auth()->user()->level;
        } else {
            $level = $user_level;
        }

        if ($level < 3) {
            return trans('game.patent1');
        } else if ($level >= 3 && $level < 6) {
            return trans('game.patent2');
        } else if ($level >= 6 && $level < 9) {
            return trans('game.patent3');
        } else if ($level >= 9 && $level < 10) {
            return trans('game.patent4');
        } else if ($level >= 10 && $level <= 11) {
            return trans('game.patent5');
        } else if ($level == 12) {
            return trans('game.patent6');
        } else if ($level == 13) {
            return trans('game.patent7');
        } else if ($level == 14) {
            return trans('game.patent8');
        } else {
            return trans('game.patent9');
        }
    }

    public function desde()
    {
        if (\App::isLocale('pt-br')) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d/m/Y');
        } else {
            return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d-m-Y');
        }
    }

    public function insignas()
    {
        return \App\Insignas::get();
        // return $this->hasOne('App\UserInsignas');
    }

    public function recent_feed()
    {
        return [
            (object) ['icon' => 'check',
                'text'           => 'Completou o primeiro capítulo: Bem Vindo ao Astrogame. Ganhou 150 XP e um chapéu',
                'date'           => '20/03/2016'],

            (object) ['icon' => 'shopping-cart',
                'text'           => 'Comprou um telescópio',
                'date'           => '21/03/2016'],

            (object) ['icon' => 'bookmark',
                'text'           => 'Ganhou a insigna da Apollo 11',
                'date'           => '21/03/2016'],

            (object) ['icon' => 'exclamation',
                'text'           => 'Completou o terceiro capítulo: Sistema Solar. Ganhou 153 XP',
                'date'           => '24/03/2016'],

        ];

    }

    public function makeAvatar($url = '')
    {
        $path   = public_path('users/avatar/' . md5($this->id) . '.jpg');
        $width  = 500;
        $height = 500;

        if (!empty($url)) {
            try {
                Image::make($url)->fit($width, $height)->save($path);
            } catch (\Intervention\Image\Exception\NotReadableException $e) {
                // default avatar
            }
        }
    }

    public function avatar(){
        $path = 'users/avatar/' . md5($this->id) . '.jpg';
        $default = 'img/avatar.png';
        if(file_exists(public_path($path))){
            return url($path);
        } else {
            return url($default);
        }
    }
}
