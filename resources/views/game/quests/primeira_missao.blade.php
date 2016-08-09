@extends('game.general.general')
@section('title')
{{ trans('chapters.welcome.title') }} | {{ trans('project.title') }}
@stop

@section('javascript')
{!! Minify::javascript(['/js/chapters/general.js'])->withFullURL() !!}
{!! Minify::javascript(['/construct/welcome/c2runtime.js'])->withFullURL() !!}">
<script>
$(document).ready(function(){
	cr_createRuntime("c2canvas");
});
</script>
@stop

@section('content')
<div id="c2canvasdiv">
<canvas id="c2canvas"></canvas>
</div>
@stop
