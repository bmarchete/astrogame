@extends('project.general')
@section('title') {{ trans('project.title') }} @stop

@section('style')
{!! Minify::stylesheet(['/vendor/uikit/css/components/slidenav.gradient.css'])->withFullURL() !!}
@stop

@section('javascript')
{!! Minify::javascript(['/vendor/uikit/js/components/lightbox.js'])->withFullURL() !!}
@stop

@section('content')
<div class="home-section">
    <div class="uk-grid" data-uk-grid-margin>
        <div class="uk-width-medium-1-1">
            <div class="uk-vertical-align uk-text-center">
                <div class="uk-vertical-align-middle uk-width-1-1 uk-width-large-1-2">
                    <h1 class="uk-heading-large">{{ trans('project.home-title') }}</h1>
                    <p class="uk-text-large">{{ trans('project.home-description') }}</p>
                    <div class="uk-button-group uk-hidden-small">
                        @if (auth()->check())
                        <a class="uk-button uk-button-success uk-button-large" href="{{ URL('/game') }}"><i class="uk-icon-gamepad"></i> {{ trans('project.jogar') }}</a> @else
                        <a class="uk-button uk-button-success uk-button-large" href="{{ URL('/login') }}"><i class="uk-icon-sign-in"></i> {{ trans('project.login') }}</a>
                        <a class="uk-button uk-button-primary uk-button-large" href="{{ URL('/login/facebook') }}"><i class="uk-icon-facebook"></i> Facebook</a>
                        <a class="uk-button uk-button-large" href="{{ URL('/register') }}"><i class="uk-icon-user-plus"></i> {{ trans('project.cadastrar') }}</a> @endif
                    </div>
                    <div class="uk-hidden-large uk-button-dropdown uk-text-left" data-uk-dropdown="{mode:'click'}" aria-haspopup="true" aria-expanded="false">
                        <button class="uk-button uk-button-success uk-button-large"><i class="uk-icon-gamepad"></i> JOGAR <i class="uk-icon-caret-down"></i></button>
                        <div class="uk-dropdown uk-dropdown-bottom">
                            <ul class="uk-nav uk-nav-dropdown">
                                <li><a href="{{ URL('/login') }}"><i class="uk-icon-sign-in"></i> {{ trans('project.login') }}</a></li>
                                <li><a href="{{ URL('/register') }}"><i class="uk-icon-user-plus"></i> {{ trans('project.cadastrar') }}</a></li>
                                <li class="uk-nav-divider"></li>
                                <li><a href="{{ URL('/login/facebook') }}"><i class="uk-icon-facebook"></i> Logar com Facebook</a></li>
                                <li><a href="{{ URL('/login/google') }}"><i class="uk-icon-google"></i> Logar com Google</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="uk-container uk-container-center uk-margin-large-top">
    <div class="uk-grid" data-uk-grid-margin data-uk-scrollspy="{cls:'uk-animation-fade', delay:100}">
        <div class="uk-width-medium-1-3">
            <div class="uk-grid">
                <div class="uk-width-1-6">
                    <i class="uk-icon-university uk-icon-large"></i>
                </div>
                <div class="uk-width-5-6">
                    <h2 class="uk-h3">{{ trans('project.home-text.title2') }}</h2>
                    <p>{{ trans('project.home-text.text2') }}</p>
                </div>
            </div>
        </div>
        <div class="uk-width-medium-1-3" data-uk-scrollspy="{cls:'uk-animation-fade', delay:300}">
            <div class="uk-grid">
                <div class="uk-width-1-6">
                    <i class="uk-icon-arrow-up uk-icon-large"></i>
                </div>
                <div class="uk-width-5-6">
                    <h2 class="uk-h3">{{ trans('project.home-text.title1') }}</h2>
                    <p>{{ trans('project.home-text.text1') }}</p>
                </div>
            </div>
        </div>
        <div class="uk-width-medium-1-3" data-uk-scrollspy="{cls:'uk-animation-fade', delay:400}">
            <div class="uk-grid">
                <div class="uk-width-1-6">
                    <i class="uk-icon-cubes uk-icon-large"></i>
                </div>
                <div class="uk-width-5-6">
                    <h2 class="uk-h3">{{ trans('project.home-text.title3') }}</h2>
                    <p>{{ trans('project.home-text.text3') }}</p>
                </div>
            </div>
        </div>
    </div>
    <hr class="uk-grid-divider">
    <div class="uk-grid" data-uk-grid-margin>
        <div class="uk-width-medium-1-2">
            <img width="660" height="400" src="img/home-section3.jpg" alt="">
        </div>
        <div class="uk-width-medium-1-2" data-uk-scrollspy="{cls:'uk-animation-fade', delay:600}">
            <h1>Explore o Universo!</h1>
            <p>Explore as estrelas, conheça os planetas de nosso sistema solar, e até mesmo os lugares mais distantes de nossa galaxia!</p>
            <h2>Ao Infinito e Além!</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            <a class="uk-button uk-button-primary" href="#">Button</a>
        </div>
    </div>
    <hr class="uk-grid-divider">
    <div class="uk-grid" data-uk-grid-margin>
        <div class="uk-width-medium-1-2 uk-text-right" data-uk-scrollspy="{cls:'uk-animation-fade', delay:600}">
            <h1>Heading</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
            <h2>Subheading</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            <a class="uk-button uk-button-primary" href="#">Button</a>
        </div>
        <div class="uk-width-medium-1-2">
            <img width="660" height="400" src="img/home-section4.jpg" alt="">
        </div>
    </div>
    <hr class="uk-grid-divider">
    <h1 class="uk-text-center">Screenshots do jogo</h1>
    <div class="uk-grid" data-uk-grid-margin>
        <div class="uk-width-1-2 uk-width-medium-1-3 uk-width-large-1-6">
            <figure class="uk-overlay uk-overlay-hover">
                <img width="350" height="150" src="img/screenshots/screenshot (5).png" alt="">
                <figcaption class="uk-overlay-panel uk-overlay-background uk-overlay-fade uk-flex uk-flex-center uk-flex-middle uk-text-center">
                    <div>Tela inicial Name</div>
                </figcaption>
                <a class="uk-position-cover" href="img/screenshots/screenshot (5).png" data-uk-lightbox="{group:'screenshots'}"></a>
            </figure>
        </div>
        <div class="uk-width-1-2 uk-width-medium-1-3 uk-width-large-1-6">
            <figure class="uk-overlay uk-overlay-hover">
                <img width="350" height="150" src="img/screenshots/screenshot (6).png" alt="">
                <figcaption class="uk-overlay-panel uk-overlay-background uk-overlay-fade uk-flex uk-flex-center uk-flex-middle uk-text-center">
                    <div>Client Name</div>
                </figcaption>
                <a class="uk-position-cover" href="img/screenshots/screenshot (6).png" data-uk-lightbox="{group:'screenshots'}"></a>
            </figure>
        </div>
        <div class="uk-width-1-2 uk-width-medium-1-3 uk-width-large-1-6">
            <figure class="uk-overlay uk-overlay-hover">
                <img width="350" height="150" src="img/screenshots/screenshot (7).png" alt="">
                <figcaption class="uk-overlay-panel uk-overlay-background uk-overlay-fade uk-flex uk-flex-center uk-flex-middle uk-text-center">
                    <div>Client Name</div>
                </figcaption>
                <a class="uk-position-cover" href="img/screenshots/screenshot (7).png" data-uk-lightbox="{group:'screenshots'}"></a>
            </figure>
        </div>
        <div class="uk-width-1-2 uk-width-medium-1-3 uk-width-large-1-6">
            <figure class="uk-overlay uk-overlay-hover">
                <img width="350" height="150" src="img/screenshots/screenshot (8).png" alt="">
                <figcaption class="uk-overlay-panel uk-overlay-background uk-overlay-fade uk-flex uk-flex-center uk-flex-middle uk-text-center">
                    <div>Client Name</div>
                </figcaption>
                <a class="uk-position-cover" href="img/screenshots/screenshot (8).png" data-uk-lightbox="{group:'screenshots'}"></a>
            </figure>
        </div>
        <div class="uk-width-1-2 uk-width-medium-1-3 uk-width-large-1-6">
            <figure class="uk-overlay uk-overlay-hover">
                <img width="350" height="150" src="img/screenshots/screenshot (9).png" alt="">
                <figcaption class="uk-overlay-panel uk-overlay-background uk-overlay-fade uk-flex uk-flex-center uk-flex-middle uk-text-center">
                    <div>Client Name</div>
                </figcaption>
                <a class="uk-position-cover" href="img/screenshots/screenshot (9).png" data-uk-lightbox="{group:'screenshots'}"></a>
            </figure>
        </div>
        <div class="uk-width-1-2 uk-width-medium-1-3 uk-width-large-1-6">
            <figure class="uk-overlay uk-overlay-hover">
                <img width="350" height="150" src="img/screenshots/screenshot (10).png" alt="">
                <figcaption class="uk-overlay-panel uk-overlay-background uk-overlay-fade uk-flex uk-flex-center uk-flex-middle uk-text-center">
                    <div>Client Name</div>
                </figcaption>
                <a class="uk-position-cover" href="img/screenshots/screenshot (10).png" data-uk-lightbox="{group:'screenshots'}"></a>
            </figure>
        </div>
    </div>
    <hr class="uk-grid-divider">
</div>
<div id="login" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        <div class="uk-modal-header">
            <h3>Login</h3></div>
        <form method="POST" action="/login" id="login-form" class="uk-form uk-align-center">
            {!! csrf_field() !!}
            <div class="uk-form-row">
                <label class="uk-form-label" for="email">Email</label>
                <div class="uk-form-controls">
                    <input type="email" name="email" id="email" required>
                </div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label" for="password">{{ trans('project.senha') }}</label>
                <div class="uk-form-controls">
                    <input type="password" name="password" id="password" required>
                </div>
            </div>
            <div class="uk-form-row">
                <label>
                    <input type="checkbox" name="remember"> {{ trans('project.remember') }}</label>
                <button type="submit" class="uk-button uk-button-success">{{ trans('project.submit') }}</button>
            </div>
            <div class="uk-form-row">
                <a href="" class="uk-button uk-button-danger"><i class="uk-icon-sign-in"></i> Google</a>
                <a href="" class="uk-button uk-button-primary"><i class="uk-icon-sign-in"></i> Facebook</a>
            </div>
        </form>
    </div>
</div>
@stop
