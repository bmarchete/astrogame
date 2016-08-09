@extends('game.general.general')
@section('title')
{{ trans('chapters.welcome.title') }} | {{ trans('project.title') }}
@stop
@section('content')
<div class="uk-container uk-container-center uk-margin-large-top">
    <div class="uk-grid">
        <div class="uk-width-1-2 uk-container-center uk-text-center">
            <h1 class="big-bang-text" style="color: #fff">{{ trans('chapters.welcome.start-text') }}</h1>
            <a href="{{ url('/game/quest/primeira_missao')}}" class="action-button red uk-width-1-1" id="big-bang"><i class="uk-icon-space-shuttle"></i> {{ trans('chapters.welcome.start-button') }}</a>
        </div>
    </div>
</div>
@stop
