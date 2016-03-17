<!DOCTYPE html>
<html lang="{{ \Lang::getLocale() }}">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>@yield('title')</title>
      <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" href="{{ URL('/vendor/uikit/css/uikit.almost-flat.css') }}">
      <link rel="stylesheet" href="{{ URL('/css/project/main.css') }}">
      @yield('style')
   </head>
   <body>
      <nav class="uk-navbar uk-navbar-attached">
         <div class="uk-container uk-container-center">
            <a class="uk-navbar-brand uk-hidden-small" href="{{ URL('/') }}"><img class="uk-margin uk-margin-remove" src="{{ URL('/img/logo.png') }}" width="190" height="40" title="Cosmos Game" alt="Cosmos Game"></a>
            <ul class="uk-navbar-nav uk-hidden-small uk-align-right">
               <li><a href="{{ URL('/') }}">{{ trans('project.navbar.home') }}</a></li>
               <li><a href="{{ URL('/jogo') }}">{{ trans('project.navbar.sobre') }}</a></li>
               <li><a href="{{ URL('/equipe') }}">{{ trans('project.navbar.equipe') }}</a></li>
               <li><a href="{{ URL('/contato') }}">{{ trans('project.navbar.contato') }}</a></li>
            </ul>
            <a href="#menu" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas></a>
            <a class="uk-navbar-brand uk-navbar-center uk-visible-small"><img src="{{ URL('/img/logo.png') }}" width="190" height="40" title="Cosmos Game" alt="Cosmos Game"></a>
         </div>
      </nav>
      <div id="menu" class="uk-offcanvas">
         <div class="uk-offcanvas-bar">
            <ul class="uk-nav uk-nav-offcanvas">
               <li class="uk-active">
                  <a href="{{ URL('/') }}"><i class="uk-icon-home"></i> {{ trans('project.navbar.home') }}</a>
               </li>
               <li><a href="{{ URL('/jogo') }}"><i class="uk-icon-gamepad"></i> {{ trans('project.navbar.sobre') }}</a></li>
               <li><a href="{{ URL('/equipe') }}"><i class="uk-icon-group"></i> {{ trans('project.navbar.equipe') }}</a></li>
               <li><a href="{{ URL('/contato') }}"><i class="uk-icon-paper-plane-o"></i> {{ trans('project.navbar.contato') }}</a></li>
               <li class="uk-nav-divider"></li>
               <li><a href="{{ URL('/termos') }}">{{ trans('project.termos') }}</a></li>
               <li><a href="{{ URL('/politica') }}">{{ trans('project.politica') }}</a></li>
            </ul>
         </div>
      </div>
      @yield('content')
      <script src="{{ URL('/vendor/jquery/jquery-2.2.1.min.js') }}"></script>
      <script src="{{ URL('/vendor/uikit/js/uikit.min.js') }}"></script>
      @yield('javascript')
   </body>
</html>