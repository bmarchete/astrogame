@extends('game.general.general')
@section('title')
Video Projeto Cosmos | {{ trans('project.title') }}
@stop

@section('javascript')
{!! Minify::javascript(['/construct/missao_projeto_cosmos_video/c2runtime.js'])->withFullURL() !!}
<script>
$(document).ready(function(){
		cr_createRuntime("c2canvas");
});
</script>
@stop

@section('content')
<div id="c2canvasdiv">
		<canvas id="c2canvas" width="1280" height="720"></canvas>
</div>
@stop
