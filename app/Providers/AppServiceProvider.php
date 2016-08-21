<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Events\RegisterUser;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ( env( 'APP_ENV', 'local' ) !== 'local' )
        {
            \DB::connection()->disableQueryLog();
        }

        User::created(function ($user) {
            event(new RegisterUser($user));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
