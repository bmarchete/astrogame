<?php

namespace App\Listeners;

use App\Events\RegisterUser;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\UserConfig;
use DB;

class RegisterUsers {

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  RegistersUsers  $event
     * @return void
     */
    public function handle(RegisterUser $event)
    {
        // instala configurações básicas de usuário
        UserConfig::installConfig($event->user->id);

        // usuário ganha 5000 conto
        DB::table('users')->where('id', $event->user->id)->update(['money' => 5000]);
        
        // autentica caso não estiver autenticado
        auth()->login($event->user, true);
    }
}
