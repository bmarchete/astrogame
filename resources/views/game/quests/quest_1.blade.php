@extends('game.general.general')
@section('title')
Quest 1 | {{ trans('project.title') }}
@stop

@section('content')
	{!! \App\Quizz::makeHTML(1) !!}
@stop