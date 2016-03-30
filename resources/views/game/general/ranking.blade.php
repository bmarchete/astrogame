@extends('game.general.general')

@section('title')
Ranking dos players
@stop


@section('content')
<style>
	.ranking {
		overflow: scroll;
		height: 475px
	}
</style>

<div class="uk-container uk-container-center" style="padding-top: 40px">
	<div class="uk-grid" data-uk-grid>
		<div class="uk-width-medium-1-4">
			<img src="{{ url('/img/logo.png') }}" alt="" width=200>
		</div>
		<div class="uk-width-medium-2-4">
			<div class="uk-panel uk-panel-box">
			<h2>Ranking Global</h2>
		    <ul class="uk-list uk-list-striped ranking">
		    @foreach ($players as $player)
		    	<li>
			        <div class="uk-border-circle" style="width: 60px; display: inline-block">
	                    <img src="{{ url('img/avatar.png') }}" alt="avatar" class="uk-border-circle avatar" data-uk-tooltip title="{{ $player->patente() }} {{ $player->name }}">
	                </div>

	                <ul class="uk-list" style="display: inline-block;">
                		<li><a href="{{ url('/game/player') . '/' . $player->id }}"><h3>{{ $player->name }}</h3></a></li>
                		<li><i class="uk-icon-space-shuttle"></i> {{ $player->patente() }} - ({{$player->xp}} XP)</li>
                	</ul>
            	</li>
		   	@endforeach
		   	</ul>
			</div>
		</div>
	</div>
</div>
@stop