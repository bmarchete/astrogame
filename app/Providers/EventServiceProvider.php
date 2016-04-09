<?php

namespace AstroGame\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Illuminate\Auth\Events\Attempting' => [
            'AstroGame\Listeners\LogAuthenticationAttempt',
        ],

        'Illuminate\Auth\Events\Login' => [
            'AstroGame\Listeners\LogSuccessfulLogin',
        ],

        'Illuminate\Auth\Events\Logout' => [
            'AstroGame\Listeners\LogSuccessfulLogout',
        ],

        'Illuminate\Auth\Events\Lockout' => [
            'AstroGame\Listeners\LogLockout',
        ],

        'Illuminate\Foundation\Auth\RegistersUsers' => [
            'AstroGame\Listeners\RegisterUsers',
        ],

        'AstroGame\Events\RegisterUser' => [
            'AstroGame\Listeners\RegisterUsers'
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);
    }
}
