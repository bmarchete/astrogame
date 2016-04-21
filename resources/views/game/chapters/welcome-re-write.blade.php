@extends('game.general.general')
@section('title')
{{ trans('chapters.welcome.title') }} | {{ trans('project.title') }}
@stop

@section('style')
<style>
video {
	display: none;
	width: 100%;
	height: 100%;
}
</style>
@stop

@section('javascript')
{!! Minify::javascript(['/vendor/popcorn/popcorn-complete.min.js',
                       '/js/chapters/general.js'])->withFullURL() !!}
<script>
$(document).ready(function(){
	// iniciadores
	var big_bang = Popcorn("#big-bang-video");
    var star_video = Popcorn("#stars-video");

	/* ======================================== */
    /* PART I - BIG BANG */
    /* ======================================== */
    
    $("#big-bang").click(function(){
        $(this).hide();
        $(".big-bang-text").hide();

        big_bang.play();
        $("#big-bang-video").show();
    });

    big_bang.code({
	  start: 21,
	  end: 22,
	  onStart: function() {
	  	change_background('{{ url('/img/chapter/big-bang-static.jpg') }}', 0);
	  	$("#big-bang-video").hide();
	  	$(".cientist").show();
        cientist('{{ trans('chapters.welcome.fala1') }}', 200);
        cientist('{{ trans('chapters.welcome.fala2') }}', 8000);
	  }
	});
});
</script>
@stop

@section('content')
<video id="big-bang-video" class="uk-responsive-width" controls="controls" preload="true">
	<source src="{{ url('/videos/big_bang.mp4') }}" type="video/mp4">
	<source src="{{ url('/videos/big_bang.webm') }}" type="video/webm">
	<source src="{{ url('/videos/big_bang.ogv') }}" type="video/ogg">
</video>

<video id="stars-video" class="uk-responsive-width" controls="controls" preload="true">
	<source src="{{ url('/videos/astro_bp.mp4') }}" type="video/mp4">
	<source src="{{ url('/videos/big_bang.webm') }}" type="video/webm">
	<source src="{{ url('/videos/big_bang.ogv') }}" type="video/ogg">
</video>


<div class="uk-container uk-container-center game-section">
    <div class="uk-grid">
        <div class="uk-width-1-1 uk-text-center">
            <h1 class="uk-width-large-1-2 uk-width-medium-1-2 uk-align-center big-bang-text" style="color: #fff">{{ trans('chapters.welcome.start-text') }}</h1>
            <button class="uk-button-primary uk-button-large" id="big-bang"><i class="uk-icon-flask"></i> {{ trans('chapters.welcome.start-button') }}</button>
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