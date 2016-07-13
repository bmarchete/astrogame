<!DOCTYPE html>
<html lang="{{ \Lang::getLocale() }}">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>@yield('title')</title>
      {!! Minify::stylesheet([
                  '/vendor/uikit/css/uikit.gradient.css',
                  '/css/game/main.css',
                  '/vendor/uikit/css/components/notify.gradient.css',
                  '/vendor/uikit/css/components/progress.gradient.css',
                  '/vendor/uikit/css/components/tooltip.gradient.css',
                  '/vendor/uikit/css/components/datepicker.gradient.css',
                  '/vendor/uikit/css/components/form-file.gradient.css',

                  ])->withFullUrl() !!}
      @yield('style')
   </head>
   <body>
      @yield('content')

      @if (auth()->check())
         @include('game.general.player-bar')
      @endif

      {!! Minify::javascript(['/vendor/jquery/jquery-2.2.1.min.js',
                              '/vendor/uikit/js/uikit.min.js',
                              '/vendor/jquery/ajaxform.min.js',
                              '/vendor/uikit/js/components/notify.min.js',
                              '/vendor/uikit/js/components/tooltip.min.js',
                              '/vendor/uikit/js/components/datepicker.min.js',
                              '/vendor/buzz/buzz.min.js'], ['async' => true])->withFullUrl() !!}
      @yield('javascript')
      @yield('javascript2')
   </body>
</html>
