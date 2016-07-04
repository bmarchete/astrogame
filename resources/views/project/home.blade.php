@extends('project.general')
@section('title') {{ trans('project.title') }} @stop

@section('style')
{!! Minify::stylesheet(['/vendor/uikit/css/components/slidenav.gradient.css'])->withFullURL() !!}
@stop

@section('javascript')
{!! Minify::javascript(['/vendor/uikit/js/components/lightbox.js'])->withFullURL() !!}
@stop

@section('content')
<div class="uk-container uk-margin-large-top uk-container-center uk-text-center-small">
    <div class="uk-grid" data-uk-grid-margin="">
        <div class="uk-vertical-align-middle uk-width-medium-3-6 uk-margin-large-top welcome">
            <h1>Bem Vindo Aventureiro!</h1>
            <h2>Preparado para explorar o universo?</h2>
            <p class="uk-text-muted">Entre em nossa plataforma interativa onde você irá explorar o Cosmos, conhecer sobre grandes nomes da astronomia e aprender sobre as estrelas, os planetas, o universo e tudo mais!</p>
            @if (auth()->check())
            <p><a class="action-button shadow animate red" href="#login" data-uk-modal=""><i class="uk-icon uk-icon-rocket"></i> Entrar no universo!</a></p>
            @else
            <p><a class="action-button shadow animate green" href="{{url('/game')}}"><i class="uk-icon uk-icon-gamepad"></i> {{trans('project.jogar')}}</a></p>
            @endif
        </div>

        <div class="uk-width-medium-3-6 uk-hidden-small">
            <div class="astronaut uk-animation-hover uk-animation-shake"></div>
        </div>
    </div>
</div>
<div class="info">
    <div class="uk-container uk-container-center">
        <div class="uk-grid" data-uk-grid-margin="">
            <div class="uk-width-medium-1-3 red-info">
                <h2><i class="uk-icon uk-icon-graduation-cap"></i> {{ trans('project.home-text.title2') }}</h2>
                <p>{{ trans('project.home-text.text2') }}</p>
            </div>
            <div class="uk-width-medium-1-3 carrot-info">
              <h2><i class="uk-icon uk-icon-level-up"></i> {{ trans('project.home-text.title1') }}</h2>
              <p>{{ trans('project.home-text.text1') }}</p>
            </div>
            <div class="uk-width-medium-1-3 yellow-info">
                <h2><i class="uk-icon uk-icon-cubes"></i> {{ trans('project.home-text.title3') }}</h2>
                <p>{{ trans('project.home-text.text3') }}</p>
            </div>
        </div>
    </div>
</div>
<div class="screenshots">
    <div class="uk-container uk-container-center">
        <div class="uk-grid" data-uk-grid="">
            <div class="uk-width-medium-1-2">
                <figure class="uk-overlay uk-overlay-hover">
                    <img alt="screenshot do astrogame" class="uk-thumbnail uk-overlay-spin" height="" src="img/screenshot.png" width="">
                    <figcaption class="uk-overlay-panel uk-overlay-slide-top">
                        Screenshot da tela inicial do jogo
                    </figcaption>
                </figure>
            </div>
            <div class="uk-width-medium-1-2">
                <h1>Sobre o Astrogame</h1>
                <p>Astrogame é um projeto de conclusão de curso (TCC) feito durante o ano de 2016 na ETEC Pedro Ferreira Alves no curso de Ensino Médio Integrado a Informática para Internet. </p>
                <p>Trata-se de uma plataforma online que disponibiliza conteúdo de astronomia, de forma interativa e de fácil compreensão, sendo o principal meio por um jogo educativo.
                    <p>
                        <p>O objetivo é suprir o déficit atual de informações acessíveis e de simples entendimento para estudantes e interessados em geral sobre astronomia.</p>

                        <a class="action-button shadow animate blue" href="#"><i class="uk-icon uk-icon-gamepad"></i> Jogar!</a>
            </div>
        </div>
    </div>
</div>
<div class="galileu">
    <div class="uk-grid" data-uk-grid="">
        <div class="uk-container uk-container-center">
            <div class="uk-vertical-align-middle">
                <div class="uk-width-1-3 uk-container-center">
                    <span class="bubble">Olá peregrino, você me conhece? Ai meus modos, nem me apresento, meu nome é Galileu Galiei, contribui muito para diversos assuntos relacionados a astronomia e estou dentro do astrogame para te ajudar em suas descobertas, clique no link para entrar no jogo!</span>
                </div>
                <div class="uk-width-1-3 uk-container-center">
                    <img class="galileu-img uk-animation-hover uk-animation-shake" alt="" src="img/char/galileu.png">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="contact">
    <div class="uk-container uk-container-center">
        <h1 class="uk-heading-large">{{ trans('project.contato-title') }}</h1>
        <p class="uk-text-large">Críticas, sugestões, dúvidas, parcerias, nos mande o que quiser, menos SPAM!</p>

        <div class="uk-grid" data-uk-grid>

            <div class="uk-width-2-3">
              <form class="uk-form uk-form-stacked" action="{{ url('/contato')}}" method="POST">
                  {!! csrf_field() !!} {!! Honeypot::generate('form_name', 'form_time') !!}
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="name">{{ trans('project.name')}}</label>
                        <div class="uk-form-controls">
                            <input type="text" name="name" placeholder="{{ trans('project.your-name') }}" class="uk-width-1-1">
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <label class="uk-form-label" for="name">{{ trans('project.email') }}</label>
                        <div class="uk-form-controls">
                            <input type="email" name="email" placeholder="{{ trans('project.your-email') }}" class="uk-width-1-1">
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <label class="uk-form-label" for="mensagem">{{ trans('project.your-message') }}</label>
                        <div class="uk-form-controls">
                            <textarea name="mensagem" rows="8" cols="40" class="uk-width-1-1"></textarea>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <button type="submit" class="action-button animate red" href="#"><i class="uk-icon-send"></i> {{ trans('project.enviar') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
