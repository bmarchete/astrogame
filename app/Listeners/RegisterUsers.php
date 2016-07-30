<?php

namespace App\Listeners;

use App\Events\RegisterUser;
use App\UserConfig;
use DB;
use Mail;

class RegisterUsers
{

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
        // faz o avatar do usuário
        $event->user->makeAvatar();

        // instala configurações básicas de usuário
        UserConfig::installConfig($event->user->id);

        // autentica caso não estiver autenticado
        auth()->login($event->user, true);

        // confirmação
        /*
        $data = ['name' => $event->user->name, 'email' => $event->user->email, 'confirm_code' => $event->user->confirm_code];
        Mail::send('emails.verify', $data, function ($message) use ($data) {
            $message->from('no-reply@astrogame.com.br', 'Astrogame');
            $message->subject('Confirmação do Astrogame');
            $message->to($data['email']);
        });
        */
    }
}
