@extends('game.general.general')
@section('title')
{{ trans('chapters.chapter1.title') }} | {{ trans('project.title') }}
@stop

@section('style')
@stop

@section('javascript')
{!! Minify::javascript(['/js/chapters/general.js'])->withFullURL() !!}
<script>
$(document).ready(function(){

});
</script>
@stop
@section('content')
<div class="uk-container uk-container-center game-section">
    <div class="uk-grid">

        </div>
        <div class="cientist-message" style="display:none">
            <div style="visibility: visible; display: block; opacity: 1;" class="uk-tooltip uk-tooltip-top">
                <div class="uk-tooltip-inner cientist-text"></div>
            </div>
        </div>
        <img data-uk-modal="{target:'#copernico'}" src="{{ URL('/img/char/copernico.png')}}" class="cientist uk-animation-hover uk-animation-shake" alt="">
    </div>
</div>
@stop
