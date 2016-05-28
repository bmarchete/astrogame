@extends('game.general.general')
@section('title')
{{ $player['name'] }} | {{ trans('project.title') }}
@stop

@section('style')
<style>
	body {
		overflow-y: scroll;
		min-height: 0
	}

	.insignas {
		overflow-y:scroll;
		max-height: 330px
	}
</style>
@stop

@section('content')
<div class="uk-container uk-container-center" style="padding-top: 40px">
    <a class="uk-button uk-button-danger" href="{{ ((\Request::header('referer')) ? Request::header('referer') : url('/')) }}"><i class="uk-icon-sign-out"></i> Voltar</a>
    <div class="uk-grid" data-uk-grid>
        <div class="uk-width-medium-1-4">
            <div class="uk-panel uk-text-center">
                <a href="{{ url('') }}">
                    <img src="{{ url('img/logo-lais.png')}}" alt="">
                </a>
            </div>
            <div class="uk-panel uk-panel-box uk-text-center">
                <figure class="uk-thumbnail uk-border-circle" style="width: 120px">
                    <img src="{{ url('users/avatar/' . md5($player->id) . '.jpg') }}" alt="avatar" class="uk-border-circle avatar" data-uk-tooltip title="{{ $player_patente }} {{ $player->name }}">
                </figure>
                <h3>{{ $player->name }}</h3>
                <ul class="uk-list uk-list-striped uk-text-left">
                    <li><i class="uk-icon-heart"></i> {{ trans('game.level') }}: <strong>{{ $player->level }}</strong></li>
                    <li><i class="uk-icon-bookmark"></i> {{ trans('game.patents') }}: <strong>{{ $player_patente }}</strong></li>
                    <li><i class="uk-icon-money"></i> {{ trans('game.money')}}: <strong>{{ $player->money }}</strong></li>
                    <li><i class="uk-icon-calendar"></i> {{ trans('game.since')}}: <strong>{{ $player->desde() }}</strong></li>
                    <li><i class="uk-icon-star"></i> {{ trans('game.ranking')}}: <strong>#1</strong></li>
                </ul>
            </div>
            <div class="uk-panel uk-panel-box uk-text-center">
                <img src="{{ url('img/camp-night.png') }}" alt="" data-uk-tooltip title="observando o céu no campo">
            </div>
        </div>
        <div class="uk-grid-divider uk-hidden-large uk-hidden-medium"></div>
        <div class="uk-width-medium-3-4">
            <div class="uk-panel uk-panel-box uk-text-center">
                <h2>Insignas</h2>
                <ul class="uk-list insignas">
                    @foreach($player->insignas() as $insigna)
                    <li>
                        <figure class="uk-thumbnail uk-border-circle" style="width: 100px">
                            <img src="{{ url('/img/insignias') }}/{{ $insigna->img_url }}.png" alt="" data-uk-tooltip title="{{ $insigna->name }}">
                        </figure>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="uk-panel uk-panel-box">
                <h2>{{ trans('game.recent-activ') }}</h2>
                <ul class="uk-list uk-list-striped uk-text-left">
                    @foreach($player->recent_feed() as $item)
                    <li><i class="uk-icon-{{ $item->icon }}"> </i> {{ $item->text }} <span class="uk-text-muted uk-text-small">{{ $item->date }}</span></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@stop
