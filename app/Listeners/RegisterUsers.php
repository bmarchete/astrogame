<?php

namespace App\Listeners;

use App\Events\RegisterUser;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\UserConfig;
use DB;

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
        UserConfig::installConfig($event->user->id);
        DB::table('users')->where('id', $event->user->id)->update(['money' => 5000]);
    }
}
