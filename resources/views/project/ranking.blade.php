@extends('project.general')

@section('title')
Ranking Global | Astrogame
@stop
@section('content')
<div class="thumbnav">
    <div class="uk-container uk-container-center">
        <h1>Ranking Geral</h1>
    </div>
</div>
<div class="ranking">
  <div class="uk-container uk-container-center">
    <div class="uk-width-large-3-6 uk-container-center">
        <div class="uk-panel uk-panel-box">
            <h2 class="uk-text-center"><i class="uk-icon uk-icon-cubes"></i> Ranking Global</h2>
            <ul class="uk-list uk-list-striped ranking-list">
              @forelse ($players as $player)
              <li>
                  <div class="uk-border-circle uk-hidden-small" style="width: 60px; display: inline-block">
                      <a href="{{ url('/player') . '/' . $player->id }}">
                        <img src="{{ $player->avatar() }}" alt="{{ $player->name }} avatar" class="uk-border-circle avatar">
                      </a>
                  </div>
                  <ul class="uk-list" style="display: inline-block;">
                      <li># <strong>{{ $player->row}}</strong> &nbsp; <a href="{{ url('/player') . '/' . $player->id }}"><strong>{{ $player->name }}</strong></a> ({{ $player->patente($player->level) }})</li>
                      <li><i class="uk-icon-exclamation"></i> Level: {{ $player->level }} - ({{$player->xp}} XP)</li>
                  </ul>
              </li>
              @empty
                <p>Acho que ninguém começou a jogar ainda :(</p>
              @endforelse
            </ul>
        </div>
        <div class="uk-margin-top uk-grid" data-uk-grid>
            <div class="uk-container-center">
              @if (!auth()->check())
                <a href="#login" class="action-button red" data-uk-modal>{{ trans('project.play')}}</a>
              @else
                <a href="{{ url('/game')}}" class="action-button red" data-uk-modal>{{ trans('project.play')}}</a>
              @endif
            </div>
        </div>
    </div>
</div>
</div>
@stop
