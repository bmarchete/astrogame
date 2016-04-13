@extends('project.general')
@section('title') {{ trans('project.termos') }} | {{ trans('project.title') }} @stop

@section('javascript')

@stop

@section('content')
<div class="uk-container uk-container-center" style="padding-top: 130px">
	<div class="uk-grid" data-uk-grid>
		<div class="uk-witdh-1-1 uk-width-large-3-4 uk-align-center">
      <h1>{{ trans('project.termos') }}</h1>
	<div class="uk-text-justify">
      	{!! trans('terms.termos') !!}
      </div>
</div>
</div>
<div class="uk-grid-divider"></div>
</div>
@stop