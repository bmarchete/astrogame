@extends('game.general.general')
@section('title')
{{ $player['name'] }} | {{ trans('project.title') }}
@stop

@section('content')
<div class="uk-container uk-container-center" style="padding-top: 40px">
	<div class="uk-grid" data-uk-grid>
		<div class="uk-width-medium-1-4">
		    <div class="uk-panel uk-panel-box uk-text-center">
		        <figure class="uk-thumbnail uk-border-circle" style="width: 120px">
                    <img src="{{ url('users/avatar/' . md5($player->id) . '.jpg') }}" alt="avatar" class="uk-border-circle avatar" data-uk-tooltip title="{{ $player_patente }} {{ $player->name }}">
                </figure>
		        <h3>{{ $player['name'] }}</h3>
		        <ul class="uk-list uk-list-striped uk-text-left">
		        	<li><i class="uk-icon-heart"></i> {{ trans('game.level') }}: <strong>{{ $player->level }}</strong></li>
		        	<li><i class="uk-icon-bookmark"></i> {{ trans('game.patents') }}: <strong>{{ $player_patente }}</strong></li>
		        	<li><i class="uk-icon-money"></i> {{ trans('game.money')}}: <strong>{{ $player->money }}</strong></li>
		        	<li><i class="uk-icon-calendar"></i> {{ trans('game.since')}}: <strong>{{ $player->desde() }}</strong></li>
		        </ul>
		    </div>
		    <div class="uk-panel uk-panel-box uk-text-center">
		    	<img src="{{ url('img/camp-night.png') }}" alt="">
		    	(campo)
		    </div>
		    
		</div>

		<div class="uk-width-medium-3-4">
			<div class="uk-panel uk-panel-box">
				<h2>{{ trans('game.recent-activ') }}</h2>
				<ul class="uk-list uk-list-striped uk-text-left">
				<li><i class="uk-icon-check"> </i> Completou o primeiro capítulo: Bem Vindo ao Astrogame. Ganhou 150 XP e um chapéu <span class="uk-text-muted uk-text-small">20/03/2016</span></li>
				<li><i class="uk-icon-check"> </i> Completou o segundo capítulo: Galileu. Ganhou 150 XP e um chapéu <span class="uk-text-muted uk-text-small">20/03/2016</span></li>
				<li><i class="uk-icon-shopping-cart"> </i> Comprou um telescópio <span class="uk-text-muted uk-text-small">21/03/2016</span></li>
				<li><i class="uk-icon-bookmark"> </i> Ganhou a insigna da Apollo 11 <span class="uk-text-muted uk-text-small">20/03/2016</span></li>
				<li><i class="uk-icon-check"> </i> Completou o terceiro capítulo: Sistema Solar. Ganhou 153 XP <span class="uk-text-muted uk-text-small">20/03/2016</span></li>
				</ul>
			</div>
		</div>
	</div>
</div>
@stop
