@extends('game.general.general')

@section('title')
Observatório
@stop

@section('style')

@stop

@section('javascript')
<script src="{{ url('/vendor/virtualsky/virtualsky.js') }}"></script>
<script>
$(document).ready(function() {

        var planetarium = $.virtualsky({
                id: 'starmap',
                projection: 'stereo',
                showstars: {{ $planetarium['showstars'] }},
                showstarlabels: {{ $planetarium['showstarlabels'] }},
                constellations: {{ $planetarium['constellations'] }},
                keyboard: true,
                lang: 'pt',
                showdate: {{ $planetarium['showdate'] }},
                showplanets: {{ $planetarium['showplanets'] }},
                showplanetlabels:  {{ $planetarium['showplanetlabels'] }},
                scalestars: 3,
                live: true,
                magnitude: {{ $planetarium['magnitude'] }},
                cardinalpoints: true,
                showposition: false,
                gradient: true,
                ground :true,
        });

        /* $('#starmap').on('dblclick', function(){
            var elem = document.getElementById("starmap");
            if (elem.requestFullscreen) {
              elem.requestFullscreen();
            } else if (elem.msRequestFullscreen) {
              elem.msRequestFullscreen();
            } else if (elem.mozRequestFullScreen) {
              elem.mozRequestFullScreen();
            } else if (elem.webkitRequestFullscreen) {
              elem.webkitRequestFullscreen();
            }
        }); */
        planetarium.fullScreen();
});
</script>
@stop

@section('content')

<div class="uk-container uk-container-center" style="padding-top: 40px">
        <div class="uk-grid" data-uk-grid>
                <div class="uk-width-medium-1-4">
                    <div class="uk-panel uk-panel-box uk-text-center">
                        <img src="{{ url('img/camp-night.png') }}" alt="">
                        (campo)
                    </div>
                    
                </div>

                <div class="uk-width-medium-3-4">
                        <div id="starmap" style="width:100%;height:500px;"></div>
                </div>
        </div>
</div>
@stop