@extends('game.general.general')

@section('title')
Mapa da Campanha | Astrogame
@stop

@section('style')
<style>
.map {
    background: url('/img/map.jpg') no-repeat center center;
    width: 100%;
    height: 800px;
}

.level {
    position: absolute;
}

.planet {
    background: url('/img/planet.png') no-repeat center center;
    top: 70px;
    left: 50px;
    width: 132px;
    height: 127px;
    display: block;
}

a {
    color: #fff;
    text-decoration: none;
    text-align: center;
    padding-top: 40px;
}

h1 {
    color: #fff
}
</style>
@stop @section('content')
<div class="uk-container uk-container-center" style="padding-top: 40px">
    <div class="uk-grid" data-uk-grid>
        <div class="uk-width-1-2 map">
            <div class="uk-panel">
                <div class="uk-panel-badge uk-badge"></div>
                <h1>Mapa da Campanha</h1>
                <div class="level level-1">
                    <a href="#">
                        <div class="planet">Copérnico</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
