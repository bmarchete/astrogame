<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Insignas;

class UserInsignas extends Model
{
    public function insigna(){
        return $this->belongsTo('App\Insignas');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function history_insigna(User $user, Insignas $insigna){
        $history = new \App\History;
        $history->user_id = $user->id;
        $history->texto = 'Ganhou a insigna <strong>' . $insigna->name . '</strong>';
        $history->icon  = 'gear';
        $history->save();
    }
}
