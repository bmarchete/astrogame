@extends('game.general.general')

@section('title')
{{ trans('chapters.chapter1.title') }} | {{ trans('chapters.chapter1.chapter')}}
@stop

@section('style')

@stop

@section('javascript')
{!! Minify::javascript('/vendor/popcorn/popcorn-complete.min.js')->withFullURL() !!}
{!! Minify::javascript('/js/chapters/general.js')->withFullURL() !!}
<script>
$(document).ready(function(){
	$(".cientist-message").show('slow');
	cientist('{{ trans('chapters.chapter1.fala1') }}');

	
	var big_video = Popcorn("#big-bang-video");
	var star_video = Popcorn("#stars-video");

	var video = document.getElementById("big-bang-video");
	var star = document.getElementById("stars-video");

	$("#big-bang").click(function(){
		$(this).hide();
		$("#big-bang-video").show();
		//fullscreen_video(video);

		big_video.play();
	});


	video.addEventListener( "ended", function( e ) {
		fullscreen_exit();

		$("#big-bang-video").hide();
		cientist('{{ trans('chapters.chapter1.fala2') }}', 100);
		cientist('{{ trans('chapters.chapter1.fala3') }}', 5000);

		change_background('{{ url('/img/chapter/big-bang-static.jpg') }}', 100);

		cientist("{{ trans('chapters.chapter1.fala4') }}", 10000);

		change_background('{{ url('/img/chapter/stars-static.jpg') }}', 11000);
		change_background('', 15000);

		cientist("{{ trans('chapters.chapter1.fala5') }}", 20000);

		setTimeout(
			function() {
				$("#stars-video").show()
				star_video.play();
			}, 21000);
		

	}, false );

	star.addEventListener("ended", function( e ) {
		$("stars-video").hide();
		UIkit.notify({message: 'Parabéns, você acaba de completar o primeiro capítulo', status: 'success'});
		UIkit.modal(".quiz-1").show();
	}, false);


});
</script>
@stop

@section('content')

<video width="1366" id="stars-video" controls="false" style="display:none" preload>
	<source src="{{URL('/videos/astro_bp.mp4')}}" type="video/mp4">
</video>

<video width="1366" id="big-bang-video" style="display:none" controls="false" preload>
	<source src="{{URL('/videos/big_bang.mp4')}}" type="video/mp4">
</video>
 
<div class="uk-container uk-container-center game-section">
	<div class="uk-grid">
		<div class="uk-width-1-1 uk-text-center">
			<button class="uk-button-danger uk-button-large" id="big-bang">{{ trans('chapters.chapter1.button1') }}</button>
		</div>

		<div class="cientist-message" style="display:none">
			<div style="visibility: visible; display: block; opacity: 1;" class="uk-tooltip uk-tooltip-top">
				<div class="uk-tooltip-inner cientist-text"></div>
			</div>
		</div>
		<img src="{{ URL('/img/char/galileu.png')}}" class="cientist uk-animation-hover uk-animation-shake" alt="">
	</div>
</div>

{!! \App\Quizz::makeHTML(1) !!}

@stop