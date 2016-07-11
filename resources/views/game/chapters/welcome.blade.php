@extends('game.general.general')
@section('title')
{{ trans('chapters.welcome.title') }} | {{ trans('project.title') }}
@stop

@section('style')
<style type="text/css">
		html, body {
			overflow: hidden;
			touch-action: none;
			-ms-touch-action: none;
		}
		canvas {
			touch-action-delay: none;
			touch-action: none;
			-ms-touch-action: none;
      width: auto;
      height: auto;
		}
    </style>
@stop

@section('javascript')
{!! Minify::javascript(['/js/chapters/general.js'])->withFullURL() !!}
<script>
$(document).ready(function(){
	$("#c2canvasdiv").hide();
	$("#big-bang").click(function(){
			$("#c2canvasdiv").show();
			cr_createRuntime("c2canvas");
	});
});
</script>

<script src="{{ url('construct/welcome/c2runtime.js') }}"></script>

    <script>

		// Pause and resume on page becoming visible/invisible
		function onVisibilityChanged() {
			if (document.hidden || document.mozHidden || document.webkitHidden || document.msHidden)
				cr_setSuspended(true);
			else
				cr_setSuspended(false);
		};

		document.addEventListener("visibilitychange", onVisibilityChanged, false);
		document.addEventListener("mozvisibilitychange", onVisibilityChanged, false);
		document.addEventListener("webkitvisibilitychange", onVisibilityChanged, false);
		document.addEventListener("msvisibilitychange", onVisibilityChanged, false);

		if (navigator.serviceWorker && navigator.serviceWorker.register)
		{
			// Register an empty service worker to trigger web app install banners.
			navigator.serviceWorker.register("{{ url('construct/welcome/sw.js') }}", { scope: "./" });
		}
    </script>
@stop

@section('content')
	<div id="c2canvasdiv">
		<canvas id="c2canvas"></canvas>
	</div>

<div class="uk-container uk-container-center game-section">
    <div class="uk-grid">
        <div class="uk-width-1-1 uk-text-center">
            <h1 class="uk-width-large-1-2 uk-width-medium-1-2 uk-align-center big-bang-text" style="color: #fff">{{ trans('chapters.welcome.start-text') }}</h1>
            <a href="#" class="action-button red" id="big-bang"><i class="uk-icon-space-shuttle"></i> {{ trans('chapters.welcome.start-button') }}</a>
        </div>
    </div>
</div>
@stop
