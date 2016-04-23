@extends('game.general.general')

@section('title')
Ranking dos players
@stop


@section('content')
<style>
	.ranking {
		overflow-y: scroll;
		height: 475px
	}

	body {
		overflow-y: scroll;
		min-height: 0
	}
</style>

<div class="uk-container uk-container-center" style="padding-top: 40px">
	<div class="uk-grid" data-uk-grid>
		<div class="uk-width-medium-1-4">
			<a href="{{ url('/') }}">
				<img src="{{ url('/img/logo.png') }}" alt="" width=200>
			</a>
		</div>
		<div class="uk-width-medium-2-4">
			<div class="uk-panel uk-panel-box">
			<h2>Ranking Global</h2>
		    <ul class="uk-list uk-list-striped ranking">
		    @foreach ($players as $player)
		    	<li>

			        <div class="uk-border-circle" style="width: 60px; display: inline-block">
	                <a href="{{ url('/player') . '/' . $player->id }}">
	                    <img src="{{ url('users/avatar/' . md5($player->id) . '.jpg') }}" alt="avatar" class="uk-border-circle avatar" data-uk-tooltip title="{{ $player->patente() }} {{ $player->name }}">
	                </a>
	                </div>

	                <ul class="uk-list" style="display: inline-block;">
                		<li><i class="uk-icon-space-shuttle"></i> {{ $player->patente() }} <a href="{{ url('/player') . '/' . $player->id }}"><strong>{{ $player->name }}</strong></a></li>
                		<li><i class="uk-icon-exclamation"></i> Level: {{ $player->level }} - ({{$player->xp}} XP)</li>
                		
                	</ul>
            	</li>
		   	@endforeach
		   	</ul>
			</div>
		</div>

		@if (!auth()->check())
		<div class="uk-width-medium-1-4 uk-text-center-small uk-text-right">
			<div class="uk-button-group">
				<a class="uk-button uk-button-success uk-button-large" href="{{ URL('/login') }}"><i class="uk-icon-sign-in"></i> {{ trans('project.login') }}</a>
                <a class="uk-button uk-button-large" href="{{ URL('/register') }}"><i class="uk-icon-user-plus"></i> {{ trans('project.cadastrar') }}</a>
			</div>
		</div>
		@endif
	</div>
</div>
@stop