@extends('game.general.general')

@section('title')
Observatório
@stop

@section('style')

@stop

@section('javascript')
{!! Minify::javascript(['/vendor/virtualsky/virtualsky.js'])->withFullURL() !!}
<script>
$(document).ready(function() {

        var planetarium = $.virtualsky({
                id: 'starmap',
                projection: 'stereo',
                showstars: true,
                showstarlabels: true,
                constellations: true,
                //keyboard: false,
                lang: 'fr',
                showdate: true,
                showplanets: true,
                showplanetlabels: true,
                scalestars: 3,
                showplanetlabels: true,
                live: true,
                magnitude: 5,
                cardinalpoints: true,
                showposition: false,
                gradient: true,
                ground :true
        });
});
</script>
@stop

@section('content')
<div class="uk-container uk-container-center">
	<div class="uk-grid" uk-data-grid>
		<h2>Observatório espacial</h2>
		<div id="starmap" style="width:100%;height:800px;"></div>
	</div>
</div>

@stop