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
@stop

@section('content')
	<div id="c2canvasdiv">
		<canvas id="c2canvas"></canvas>
	</div>

<div class="uk-container uk-container-center uk-margin-large-top">
    <div class="uk-grid">
        <div class="uk-width-1-2 uk-container-center uk-text-center">
            <h1 class="big-bang-text" style="color: #fff">{{ trans('chapters.welcome.start-text') }}</h1>
            <a href="#" class="action-button red uk-width-1-1" id="big-bang"><i class="uk-icon-space-shuttle"></i> {{ trans('chapters.welcome.start-button') }}</a>
        </div>
    </div>
</div>
@stop
