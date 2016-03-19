@extends('game.general.general')

@section('title')
{{ trans('chapters.chapter1.title') }} | {{ trans('chapters.chapter1.chapter')}}
@stop

@section('style')

@stop

@section('javascript')
{!! Minify::javascript('/vendor/popcorn/popcorn-complete.min.js')->withFullURL() !!}
<script>
function cientist(message, timer){
	setTimeout(function(){
    	$(".cientist-message").hide();
    	$(".cientist-text").html(message);
    	$(".cientist-message").show('slow');
	}, timer);
}

function fullscreen_video(video){
	if (video.requestFullscreen) {
		video.requestFullscreen();
	} else if (video.mozRequestFullScreen) {
		video.mozRequestFullScreen();
	} else if (video.webkitRequestFullscreen) {
		video.webkitRequestFullscreen();
	}
	
}

function fullscreen_exit(){
	if (document.exitFullscreen) {
		document.exitFullscreen();
	} else if (document.webkitExitFullscreen) {
		document.webkitExitFullscreen();
	} else if (document.mozCancelFullScreen) {
		document.mozCancelFullScreen();
	} else if (document.msExitFullscreen) {
		document.msExitFullscreen();
	}
}

$(document).ready(function(){
	$(".cientist-message").show('slow');

	cientist('{{ trans('chapters.chapter1.fala1') }}', 100);
	cientist('{{ trans('chapters.chapter1.fala2') }}', 4000);

	var big_video = Popcorn("#big-bang-video");
	var video = document.getElementById("big-bang-video");

	$("#big-bang").click(function(){
		cientist('{{ trans('chapters.chapter1.fala3') }}', 100);
		setTimeout(function () { $('.cientist-message').hide('slow'); }, 500);

		$(this).hide();
		$("#big-bang-video").show('slow');
		fullscreen_video(video);

		big_video.play();
	});


	video.addEventListener( "ended", function( e ) {
		fullscreen_exit();

		$("#big-bang-video").hide();
		cientist('{{ trans('chapters.chapter1.fala4') }}', 100);

	}, false );


});
</script>
@stop

@section('content')
<div class="uk-container uk-container-center game-section">
	<div class="uk-grid">
		<div class="uk-width-1-1 uk-text-center">
			<button class="uk-button-success uk-button-large" id="big-bang">{{ trans('chapters.chapter1.button') }}</button>
		</div>

		<video width="500" height="300" id="big-bang-video" style="display:none" controls="false" preload>
			<source src="{{URL('/videos/big_bang.mp4')}}">
		</video>

		<div class="cientist-message" style="display:none">
			<div style="visibility: visible; display: block; opacity: 1;" class="uk-tooltip uk-tooltip-top">
				<div class="uk-tooltip-inner cientist-text"></div>
			</div>
		</div>
		<img src="{{ URL('/img/char/galileu.png')}}" class="cientist uk-animation-hover uk-animation-shake" alt="">
	</div>
</div>
@stop