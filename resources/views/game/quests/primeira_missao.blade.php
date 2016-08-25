@extends('game.general.general')
@section('title')
{{ trans('chapters.welcome.title') }} | {{ trans('project.title') }}
@stop

@section('javascript')
{!! Minify::javascript(['/construct/primeira_missao/c2runtime.js'])->withFullURL() !!}
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
