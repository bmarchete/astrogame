@extends('project.general')

@section('title')
  {{ the_title() }}
@stop

@section('head')
{!! wp_head() !!}
@stop

@section('footer')
{!! wp_footer() !!}
@stop
