@extends('game.general.general')
@section('title')
Projeto Cosmos Quizz | {{ trans('project.title') }}
@stop

@section('javascript')
{!! Minify::javascript(['/js/chapters/general.js'])->withFullURL() !!}
{!! Minify::javascript(['/construct/quest_cosmos/c2runtime.js'])->withFullURL() !!}">
<script>
$(document).ready(function(){
		$("#c2canvasdiv").show();
		cr_createRuntime("c2canvas");
});
</script>
@stop

@section('content')
<div id="c2canvasdiv">
		<canvas id="c2canvas"></canvas>
</div>
@stop
