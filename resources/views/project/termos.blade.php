@extends('project.general') @section('title') {{ trans('project.termos') }} | {{ trans('project.title') }} @stop @section('content')
<div class="thumbnav">
    <div class="uk-container uk-container-center">
        <h1>{{ trans('project.termos') }}</h1>
    </div>
</div>
<div class="white">
<div class="uk-container uk-container-center">
    <div class="uk-grid uk-margin-large-top" data-uk-grid>
        <div class="uk-witdh-1-1 uk-width-large-3-4 uk-align-center">
            <div class="uk-text-justify">
                {!! trans('terms.termos') !!}
            </div>
        </div>
    </div>
    <hr class="uk-grid-divider">
</div>
</div>
@stop
