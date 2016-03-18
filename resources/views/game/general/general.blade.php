<!DOCTYPE html>
<html lang="{{ \Lang::getLocale() }}">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>@yield('title')</title>
      {!! Minify::stylesheet('/vendor/uikit/css/uikit.gradient.css') !!}
      @yield('style')
   </head>
   <body>
      @yield('content')
      @include('game.general.player-bar')
      @include('game.general.footer')
      {!! Minify::javascript('/vendor/jquery/jquery-2.2.1.min.js') !!}
      {!! Minify::javascript('/vendor/uikit/js/uikit.min.js') !!}
      @yield('javascript')
   </body>
</html>