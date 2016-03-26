@extends('game.general.general')
@section('title')
{{ trans('chapters.welcome.title') }} | {{ trans('project.title') }}
@stop

@section('style')
@stop

@section('javascript')
{!! Minify::javascript(['/vendor/popcorn/popcorn-complete.min.js',
                       '/js/chapters/general.js'])->withFullURL() !!}
<script>
$(document).ready(function(){
	UIkit.notify({message: '<i class="uk-icon-exclamation"> </i> Você ganhou 100 xp!', status: 'success', pos:'top-right'});
	UIkit.notify({message: '<i class="uk-icon-exclamation"> </i> Parabéns, você acabou de completar as boas vindas!', status: 'success', pos:'top-right'});

	$("#pular").click(function(){
		window.location('{{ url('/pular') }}');
	});

	$("#bora").click(function(){
		$("#capitulo").hide();
		$(".cientist").show();
		$(".cientist-message").show();
		cientist("Olá, meu nome é Galileu", 100);
	});
});
</script>
@stop

@section('content')

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