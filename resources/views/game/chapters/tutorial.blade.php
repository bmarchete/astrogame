@extends('game.general.general')
@section('title')
{{ trans('chapters.tutorial.title') }} | {{ trans('project.title') }}
@stop

@section('style')
@stop

@section('javascript')
{!! Minify::javascript(['/vendor/popcorn/popcorn-complete.min.js',
                       '/js/chapters/general.js'])->withFullURL() !!}
<script>
$(document).ready(function() {
    $("#pular").click(function() {
        UIkit.modal.confirm("Tem certeza disso? Não vou explicar como funciona depois, e você vai ficar perdidão ai.", function() {
            UIkit.modal.confirm("Certeza mesmo?", function() {
                window.location = '{{ url(' / game / chapter1 ') }}';
            });
        });
    });

    $("#bora").click(function() {
        $("#capitulo").hide();
        $(".cientist").show();
        $(".cientist-message").show();

        cientist("{{ trans('chapters.tutorial.fala1') }}", 150);
        cientist("{{ trans('chapters.tutorial.fala2') }}", 10000);
        setTimeout(function() {
            $("body").css("background", "url('{{ url('/img/chapter/night-sky-stars.jpeg') }}') center bottom / cover");
        }, 10000);



        cientist("{{ trans('chapters.tutorial.fala3') }}", 20000);
        setTimeout(function() {
            $("body").css("background", "url('{{ url('/img/chapter/wallpaper-crateras-da-lua-5650.jpg') }}') center top / cover");
        }, 21000);
        setTimeout(function() {
            $("body").css("background", "url('{{ url('/img/chapter/20000719_1320_eit304_1024.jpg') }}') center center / cover");
        }, 24000);
        setTimeout(function() {
            $("body").css("background", "url('{{ url('/img/chapter/606605main_jupiter2_lg.jpg') }}') center center / cover");
        }, 27000);

        setTimeout(function() {
            $("body").removeAttr('style');
        }, 30000);
        cientist("{{ trans('chapters.tutorial.fala4') }}", 30000);


        setTimeout(function() {

            cientist("{{ trans('chapters.tutorial.fala5') }}", 0);

            var shop = UIkit.modal("#shop");
            shop.show();

        }, 40000);
    });



});

function buyTutorialHander() {
    cientist("{{ trans('chapters.tutorial.fala6') }}", 0);
}

function buyTutorialLivroHandler() {
    cientist_text('{{ trans('
        chapters.tutorial.fala7 ') }}').delay(0);
    cientist_text('{{ trans('
        chapters.tutorial.fala7 ') }}').delay(10000);

    // bug suggestions
    //setTimeout(function() { window.location = '{{ url('/game/chapter1') }}'; } , 20000);
}
</script>
@stop @section('content')
<div class="uk-container uk-container-center game-section">
    <div class="uk-grid">
        <div class="uk-width-1-1 uk-text-center">
            <div id="capitulo" class="uk-panel uk-panel-box uk-width-2-3 uk-align-center">
                <h2>Capítulo I (Tutorial)</h2>
                <p>Aprenda um pouco sobre Astrogame, um guia rápido de onde localizar as funcionalidades, como menu do jogador, missões, loja, mochila e outras funcionalidades do jogo.</p>
                <div class="uk-button-group">
                    <button id="pular" class="uk-button uk-button-danger uk-button-large"><i class="uk-icon-close"></i> Pular</button>
                    <button id="bora" class="uk-button uk-button-success uk-button-large"><i class="uk-icon-check"></i> Bora</button>
                </div>
            </div>
        </div>
        <div class="cientist-message" style="display:none">
            <div style="visibility: visible; display: block; opacity: 1;" class="uk-tooltip uk-tooltip-top">
                <div class="uk-tooltip-inner cientist-text"></div>
            </div>
        </div>
        <img src="{{ URL('/img/char/galileu.png')}}" class="cientist uk-animation-hover uk-animation-shake" alt="" style="display:none">
    </div>
</div>
@stop
