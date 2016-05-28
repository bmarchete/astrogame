@extends('project.general') @section('title') Política de Privacidade | {{ trans('project.title') }} @stop @section('content')
<div class="uk-container uk-container-center" style="padding-top: 130px">
    <div class="uk-grid" data-uk-grid>
        <div class="uk-witdh-1-1 uk-width-large-3-4 uk-align-center">
            <h1>Política de Privacidade</h1>
            <div class="uk-text-justify">
                {!! trans('terms.privacidade') !!}
            </div>
        </div>
    </div>
    <hr class="uk-grid-divider">
</div>
@stop
