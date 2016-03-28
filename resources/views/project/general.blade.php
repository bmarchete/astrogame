<!DOCTYPE html>
<html lang="{{ \Lang::getLocale() }}">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>@yield('title')</title>
      {!! Minify::stylesheet(['https://fonts.googleapis.com/css?family=Roboto',
                              '/vendor/uikit/css/uikit.gradient.css',
                              '/css/project/main.css'])->withFullUrl() !!}
      @yield('style')
   </head>
   <body>
      <nav class="uk-navbar uk-navbar-attached">
         <div class="uk-container uk-container-center">
            <a class="uk-navbar-brand uk-hidden-small" href="{{ URL('/') }}"><img class="uk-margin uk-margin-remove" src="{{ URL('/img/logo.png') }}" width="190" height="40" title="Cosmos Game" alt="Cosmos Game"></a>
            <ul class="uk-navbar-nav uk-hidden-small uk-align-right">
               <li><a href="{{ URL('/') }}">{{ trans('project.navbar.home') }}</a></li>
               <li><a href="{{ URL('/sobre') }}">{{ trans('project.navbar.sobre') }}</a></li>
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
               @if (!isset($page))
               {{ $page = 'index' }} <!-- HACK // PLEASE FOR GOD'S SAKE, REMOVE THIS -->
               @endif
               <li @if ($page == 'index') class="uk-active" @endif>
                  <a href="{{ URL('/') }}"><i class="uk-icon-home"></i> {{ trans('project.navbar.home') }}</a>
               </li>
               <li @if ($page == 'sobre') class="uk-active" @endif><a href="{{ URL('/sobre') }}"><i class="uk-icon-gamepad"></i> {{ trans('project.navbar.sobre') }}</a></li>
               <li @if ($page == 'equipe') class="uk-active" @endif><a href="{{ URL('/equipe') }}"><i class="uk-icon-group"></i> {{ trans('project.navbar.equipe') }}</a></li>
               <li @if ($page == 'contato') class="uk-active" @endif><a href="{{ URL('/contato') }}"><i class="uk-icon-paper-plane-o"></i> {{ trans('project.navbar.contato') }}</a></li>
               <li class="uk-nav-divider"></li>
               <li @if ($page == 'login') class="uk-active" @endif><a href="{{ URL('/login') }}"><i class="uk-icon-sign-in"></i> {{ trans('project.login') }}</a></li>
               <li><a href="{{ URL('/login/facebook') }}"><i class="uk-icon-facebook"></i> Login com facebook</a></li>
               <li @if ($page == 'register') class="uk-active" @endif><a href="{{ URL('/register') }}"><i class="uk-icon-user-plus"></i> {{ trans('project.cadastrar') }}</a></li>
               
               <li class="uk-nav-divider"></li>
               <li @if ($page == 'termos') class="uk-active" @endif><a href="{{ URL('/termos') }}"><i class="uk-icon-paper-plane"></i> {{ trans('project.termos') }}</a></li>
               <li @if ($page == 'politica') class="uk-active" @endif><a href="{{ URL('/politica') }}"><i class="uk-icon-paper-plane"></i> {{ trans('project.politica') }}</a></li>
            </ul>
         </div>
      </div>
      @yield('content')
      @include('project.footer')
      {!! Minify::javascript(['/vendor/jquery/jquery-2.2.1.min.js',
                              '/vendor/uikit/js/uikit.min.js'])->withFullUrl() !!}
      @yield('javascript')
   </body>
</html>