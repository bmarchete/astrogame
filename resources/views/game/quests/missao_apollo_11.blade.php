@extends('game.general.general')
@section('title')
Apollo 11 | {{ trans('project.title') }}
@stop

@section('javascript')
<script>
$(document).ready(function(){
		background3.play();
});
var quest = 'missao_apollo_11';
var videoId = 'GnMRJ5F8swo';
</script>
{!! Minify::javascript(['/js/game/simples-youtube.js'])->withFullURL() !!}
@stop

@section('content')
<div class="video-container">
    <div id="video"></div>
</div>
<script src="https://www.youtube.com/iframe_api"></script>
@stop
