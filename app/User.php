<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;
use Image;
use DB;
use Cache;

class User extends Authenticatable
{

    public $level_xp =
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
     *  User Eloquent relations
     */
    public function insignas()
    {
        return $this->hasMany('App\UserInsignas');
    }

    public function history()
    {
        return $this->hasMany('App\History');
    }

    public function config(){
        return $this->hasMany('App\UserConfig');
    }

    public function user_bag(){
        return $this->hasMany('App\UserBag');
    }

    /**
     * Função para aumentar pontos de xp do jogador
     *  @TODO: REFACTOR
     * @param int xp
     * @return void
     */
    public function gain_xp($xp)
    {
        $this->xp += $xp;

        while($this->xp >= $this->xp_for_next_level()){
            $this->level += 1;
        }

        $this->save();
    }

    public function gain_money($money){
        $this->money += $money;
        $this->save();
    }

    public function remove_money($money){
      $final = $this->money - $money;
      if($final > $this->money){
          $this->money = 0;
      } else {
          $this->money = $final;
      }

      $this->save();
    }

    // pega o xp e transforma em porcentagem
    public function xp_bar()
    {
        $porcent = ($this->xp * 100) / $this->xp_for_next_level();
        return round($porcent);
    }

    public function xp_for_next_level()
    {
        $counter = count($this->level_xp);
        $max = $counter + 1;

        if( ($this->level + 1) >= $max){
            return $this->level_xp[$counter];
        } else {
            return $this->level_xp[$this->level + 1];
        }
    }

    public function patente()
    {
        if ($this->type == 3) {
            return trans('game.patent-gm');
        }

        if ($this->level <= 3) {
            return trans('game.patent1');
        } else if ($this->level >= 4 && $this->level <= 6) {
            return trans('game.patent2');
        } else if ($this->level >= 7 && $this->level <= 9) {
            return trans('game.patent3');
        } else if ($this->level >= 10 && $this->level < 12) {
            return trans('game.patent4');
        } else if ($this->level >= 13 && $this->level <= 14) {
            return trans('game.patent5');
        } else {
            return trans('game.patent6');
        }
    }

    public function desde()
    {
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at);

        return (\App::isLocale('pt-br')) ? $date->format('d/m/Y') : $date->format('d-m-Y');
    }



    public function makeAvatar($url = '')
    {
        $path   = public_path('users/avatar/' . md5($this->id) . '.jpg');
        $width  = 500;
        $height = 500;

        // caso já existir um avatar no lugar
        if(file_exists($path)){
            unlink($path);
        }

        if (!empty($url)) {
            try {
                $avatar = Image::make($url)->fit($width, $height)->save($path);

            } catch (Exception $e) {
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



    public function getConfig($config_key){
        return \App\UserConfig::getConfig($config_key, $this);
    }

    public function isOnline() {
        if(Cache::has('user-is-online-' . $this->id)){
            $this->online = true;
            $this->save();
            return true;
        } else {
            $this->online = false;
            $this->save();
            return false;
        }
    }

    public function bag()
    {
        return $this->user_bag()->with('item')->select(DB::raw("SUM(amount) as 'amount', id, item_id, user_id"))
                    ->groupBy('item_id')->get();
    }

    public function has_item($item_id)
    {
        $check_item = $this->user_bag()->select('id')->where('item_id', $item_id)->limit(1)->first();
        return ($check_item) ? true : false;
    }

    public function has_item_amount($item_id)
    {
        $bag_item = $this->user_bag()->with('item')->select(DB::raw("SUM(amount) as 'amount'"))
                         ->where('item_id', $item_id)->groupBy('item_id')->limit(1)->first();
        return ($bag_item) ? $bag_item->amount : 0;
    }

    public function generate_nickname(){
        $from = 'áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ';
        $to = 'aaaaeeiooouucAAAAEEIOOOUUC';

        $nickname = strtolower(strtr(str_replace(' ', '', $this->name), $from, $to));

        $count = 1;
        if ($this->where('username', $nickname)->select('id')->first()) {
            $new_nickname = $nickname . $count;
            while ($this->where('username', $new_nickname)->select('id')->first()) {
                $count++;
                $new_nickname = $nickname . $count;
            }
        }
        $this->nickname = isset($new_username) ? $new_nickname : $nickname;
        return $this->nickname;
    }
}
