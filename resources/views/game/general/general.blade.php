<!DOCTYPE html>
<html lang="{{ \Lang::getLocale() }}">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>@yield('title')</title>
      {!! Minify::stylesheet('/vendor/uikit/css/uikit.gradient.css')->withFullUrl() !!}
      @yield('style')
   </head>
   <body>
      @yield('content')
      @include('game.general.player-bar')
      {!! Minify::javascript(['/vendor/jquery/jquery-2.2.1.min.js', 
                              '/vendor/uikit/js/uikit.min.js'])->withFullUrl() !!}
      @yield('javascript')
   </body>
</html>