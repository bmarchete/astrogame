<!DOCTYPE html>
<html lang="{{ \Lang::getLocale() }}">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>@yield('title')</title>
      <link rel="stylesheet" href="{{ URL('/vendor/uikit/css/uikit.gradient.css') }}">
      @yield('style')
   </head>
   <body>
      @yield('content')
      <script src="{{ URL('/vendor/jquery/jquery-2.2.1.min.js') }}"></script>
      <script src="{{ URL('/vendor/uikit/js/uikit.min.js') }}"></script>
      @yield('javascript')
   </body>
</html>