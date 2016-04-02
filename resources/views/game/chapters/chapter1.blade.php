@extends('game.general.general')
@section('title')
{{ trans('chapters.chapter1.title') }} | {{ trans('project.title') }}
@stop

@section('style')
@stop

@section('javascript')
{!! Minify::javascript(['/vendor/popcorn/popcorn-complete.min.js',
                       '/js/chapters/general.js'])->withFullURL() !!}
<script>
$(document).ready(function(){

    var nebulosa = Popcorn("#nebulosa");
    var nebulosa = document.getElementById("nebulosa");

    $("#start").click(function() {
    	$("#capitulo").hide();
    	$("#nebulosa").show();
    	nebulosa.play();

    	$(".cientist").show();
    	cientist("{{ trans('chapters.chapter1.fala1') }}", 1000);
    	cientist("{{ trans('chapters.chapter1.fala2') }}", 10000);
    	
    	cientist("{{ trans('chapters.chapter1.fala3') }}", 16000);
    	cientist("{{ trans('chapters.chapter1.fala4') }}", 23000);
    	cientist("{{ trans('chapters.chapter1.fala5') }}", 30000);
 
    });
});

</script>
@stop
@section('content')
<video width="1366" id="nebulosa" style="display:none" controls="false" preload>
    <source src="{{URL('/videos/orion_nebulosa.m4v')}}" >
</video>

<div class="uk-container uk-container-center game-section">
    <div class="uk-grid">
        <div class="uk-width-1-1 uk-text-center">
        <div id="capitulo" class="uk-panel uk-panel-box uk-width-2-3 uk-align-center">
		    <h2>Capítulo II (Começo)</h2>
		    <p>Agora vai</p>
		    <div class="uk-button-group">
		    	<button id="start" class="uk-button uk-button-success uk-button-large"><i class="uk-icon-check"></i> Começar</button>
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