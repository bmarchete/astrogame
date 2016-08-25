@extends('project.general')

@section('title')
  {{ the_title() }}
@stop

@section('head')
{!! get_header() !!}
@stop

@section('footer')
{!! get_footer() !!}
@stop
