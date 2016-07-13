<!DOCTYPE html>
<html dir="ltr" lang="{{ \Lang::getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Entre em nossa plataforma interativa onde você irá explorar o Cosmos, conhecer sobre grandes nomes da astronomia e aprender sobre as estrelas, os planetas, o universo e tudo mais!">
    <meta name="author" content="Eduardo Augusto Ramos">
    <title>@yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    {!! Minify::stylesheet(['/vendor/uikit/css/normalize.css', '/vendor/uikit/css/uikit.gradient.css', '/css/project/main.css'])->withFullUrl() !!}
    @yield('style')
    <link rel="icon" type="image/png" href="/img/favicon/favicon-32x32.png" sizes="32x32">

</head>
<body>
  <nav class="uk-navbar uk-navbar-attached">
      <div class="uk-container uk-container-center">
          <a class="uk-navbar-brand uk-hidden-small uk-logo" href="{{ url('/') }}"><img alt="astrogame logo" class='logo' src="{{ url('img/logo-full.png') }}"></a>
          <ul class="uk-navbar-nav uk-hidden-small">
            @if (!isset($page))
            <?php
              $page = 'index'; //HACK PLEASE FOR GOD'S SAKE, REMOVE THIS
            ?>
            @endif
            <li @if ($page=='index' ) class="uk-active" @endif><a href="{{ URL('/') }}">{{ trans('project.navbar.home') }}</a></li>
            <li @if ($page=='sobre' ) class="uk-active" @endif><a href="{{ URL('/sobre') }}">{{ trans('project.navbar.sobre') }}</a></li>
            <li @if ($page=='equipe' ) class="uk-active" @endif><a href="{{ URL('/equipe') }}">{{ trans('project.navbar.equipe') }}</a></li>
            <li @if ($page=='ranking' ) class="uk-active" @endif><a href="{{ URL('/ranking') }}">{{ trans('project.navbar.ranking') }}</a></li>
            <li @if ($page=='contato' ) class="uk-active" @endif><a href="{{ URL('/contato') }}">{{ trans('project.navbar.contato') }}</a></li>
          </ul>
          <a class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas="" href="#offcanvas"></a>
          <div class="uk-navbar-center uk-visible-small">
              <a href="{{ url('/')}}">
                  <img alt="astrogame logo" class='logo' src="{{url('img/logo-full.png')}}">
              </a>
          </div>
      </div>
  </nav>
  <div class="uk-offcanvas" id="offcanvas">
      <div class="uk-offcanvas-bar">
          <ul class="uk-nav uk-nav-offcanvas">
            <li @if ($page=='index' ) class="uk-active" @endif>
                <a href="{{ URL('/') }}"><i class="uk-icon-home"></i> {{ trans('project.navbar.home') }}</a>
            </li>
            <li @if ($page=='sobre' ) class="uk-active" @endif><a href="{{ URL('/sobre') }}"><i class="uk-icon-gamepad"></i> {{ trans('project.navbar.sobre') }}</a></li>
            <li @if ($page=='equipe' ) class="uk-active" @endif><a href="{{ URL('/equipe') }}"><i class="uk-icon-group"></i> {{ trans('project.navbar.equipe') }}</a></li>
            <li @if ($page=='contato' ) class="uk-active" @endif><a href="{{ URL('/contato') }}"><i class="uk-icon-paper-plane-o"></i> {{ trans('project.navbar.contato') }}</a></li>

            <li class="uk-nav-divider"></li>
            <li><a href="{{ URL('/login/facebook') }}"><i class="uk-icon-facebook"></i> Login com facebook</a></li>
            <li @if ($page=='login' ) class="uk-active" @endif><a href="{{ URL('/login') }}"><i class="uk-icon-sign-in"></i> {{ trans('project.login') }}</a></li>
            <li @if ($page=='register' ) class="uk-active" @endif><a href="{{ URL('/register') }}"><i class="uk-icon-user-plus"></i> {{ trans('project.cadastrar') }}</a></li>
          </ul>
      </div>
  </div>
    @yield('content')
    @include('project.footer')

    <div id="login" class="uk-modal">
        <div class="uk-modal-dialog">
            <a href="" class="uk-modal-close uk-close"></a>
            <h2>Entrar no Astrogame</h2>
            <br>
            <form class="uk-form uk-width-1-1 uk-container-center" method="POST" action="{{url('/login')}}">
                {!! csrf_field() !!}

                <div class="uk-form-row">
                    <input class="uk-width-1-1 uk-form-large" type="text" name="login" value="{{ old('email-or-nickname') }}" placeholder="{{ trans('project.email-or-nickname')}}" required>
                </div>
                <div class="uk-form-row">
                    <input class="uk-width-1-1 uk-form-large" type="password" name="password" placeholder="{{ trans('project.password')}}" required>
                </div>
                <div class="uk-form-row uk-text-small">
                    <label class="uk-float-left">
                        <input type="checkbox" name="remember" checked> {{ trans('project.remember')}}</label>
                    <a class="uk-float-right uk-link uk-link-muted" href="{{ url('password/reset')}}">{{ trans('project.forget-password') }}</a>
                </div>
                <div class="uk-form-row">
                      <button type="submit" class="action-button green uk-width-1-1"><i class="uk-icon-sign-in"></i> {{ trans('project.submit') }}</button>
                      <a class="action-button blue uk-width-1-1" href="{{ URL('/login/facebook') }}"><i class="uk-icon-facebook"></i> Facebook</a>
                      <a href="#register" data-uk-modal="" class="action-button red uk-width-1-1"><i class="uk-icon-user-plus"></i> {{ trans('project.register')}}</a>
                </div>
            </form>
        </div>
    </div>

    <div id="register" class="uk-modal">
        <div class="uk-modal-dialog">
            <a href="" class="uk-modal-close uk-close"></a>
            <h2>Registrar no Astrogame</h2>
            <br>

            <form class="uk-form uk-width-1-1 uk-container-center" method="POST" action="{{url('/register')}}">
                  {!! csrf_field() !!}
                  <div class="uk-form-row">
                     <input class="uk-width-1-1 uk-form-large" type="text" name="name" value="{{ old('name') }}" placeholder="{{ trans('project.name')}}" required>
                  </div>
                <div class="uk-form-row">
                    <input class="uk-width-1-1 uk-form-large" type="text" name="nickname" value="{{ old('nickname') }}" placeholder="{{ trans('project.nickname') }}" required maxlength="60">
                </div>
                <div class="uk-form-row">
                    <input class="uk-width-1-1 uk-form-large" type="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
                </div>
                <div class="uk-form-row">
                    <input class="uk-width-1-1 uk-form-large" type="password" name="password" value="{{ old('password') }}" placeholder="{{ trans('project.password') }}" required>
                </div>

                <div class="uk-form-row">
                   {!! Recaptcha::render() !!}
                </div>

                <div class="uk-form-row uk-text-small">
                    <div class="uk-float-left">
                        <input type="checkbox" name="terms" required>
                        <label for="terms">{{ trans('project.termos-1') }} <a href="{{ url('/termos')}}">{{ trans('project.termos-2') }}</a></label>
                    </div>
                    <a class="uk-float-right uk-link uk-link-muted" href="#login" data-uk-modal>{{ trans('project.login-register') }}</a>
                </div>
                <div class="uk-form-row">
                    <button type="submit" class="action-button shadow red uk-width-1-1"><i class="uk-icon-user-plus"></i> {{ trans('project.cadastrar') }}</button>
                    <a class="action-button shadow blue uk-width-1-1" href="{{ URL('/login/facebook') }}"><i class="uk-icon-facebook"></i> {{ trans('project.facebook') }}</a>
                </div>
            </form>
        </div>
    </div>
    {!! Minify::javascript(['/vendor/jquery/jquery-2.2.1.min.js', '/vendor/uikit/js/uikit.min.js'])->withFullUrl() !!}
    @yield('javascript')
</body>
</html>
