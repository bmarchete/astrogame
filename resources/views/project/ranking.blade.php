@extends('project.general')

@section('title')
Ranking
@stop
@section('content')
<div class="thumbnav">
    <div class="uk-container uk-container-center">
        <h1>Ranking Geral</h1>
    </div>
</div>
<div class="ranking">
  <div class="uk-container uk-container-center">
    <div class="uk-width-medium-2-5 uk-container-center">
        <div class="uk-panel uk-panel-box">
            <h2 class="uk-text-center"><i class="uk-icon uk-icon-cubes"></i> Ranking Global</h2>
            <ul class="uk-list uk-list-striped ranking-list">
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
        @if (!auth()->check())
        <div class="uk-text-center uk-margin-top">
          <a href="" class="action-button red">Jogar</a>
        </div>
        @endif

    </div>
</div>
</div>
@stop
