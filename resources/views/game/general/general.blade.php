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
                  '/vendor/uikit/css/components/tooltip.gradient.css'
                  ])->withFullUrl() !!}
      @yield('style')
   </head>
   <body>
      @yield('content')
      @include('game.general.player-bar')
      {!! Minify::javascript(['/vendor/jquery/jquery-2.2.1.min.js', 
                              '/vendor/uikit/js/uikit.min.js',
                              '/vendor/jquery/ajaxform.min.js',
                              '/vendor/uikit/js/components/notify.min.js',
                              '/vendor/uikit/js/components/tooltip.min.js',
                              '/vendor/buzz/buzz.min.js'])->withFullUrl() !!}
      @yield('javascript')
      @yield('javascript2')
   </body>
</html>