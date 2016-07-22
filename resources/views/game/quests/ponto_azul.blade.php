@extends('game.general.general')
@section('title')
Pequeno pálido ponto azul | {{ trans('project.title') }}
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
	$("#c2canvasdiv").show();
	cr_createRuntime("c2canvas");
});
</script>

<script src="{{ url('construct/quest_ponto/c2runtime.js') }}"></script>
@stop

@section('content')
<div id="c2canvasdiv">
		<canvas id="c2canvas"></canvas>
</div>
@stop
