@extends('game.general.general')
@section('title')
{{ trans('chapters.welcome.title') }} | {{ trans('project.title') }}
@stop

@section('style')
@stop

@section('javascript')
{!! Minify::javascript(['/vendor/popcorn/popcorn-complete.min.js',
                       '/js/chapters/general.js'])->withFullURL() !!}
<script>
$(document).ready(function(){

    /* ======================================== */
    /* PART I - BIG BANG */
    /* ======================================== */
    var big_bang = Popcorn("#big-bang-video");
    var big_bang_video = document.getElementById("big-bang-video");

    var star_video = Popcorn("#stars-video");
    var star_video_element = document.getElementById("stars-video");

    $("#big-bang").click(function(){
        $(this).hide();
        $(".big-bang-text").hide();

        big_bang.play();
        $("#big-bang-video").show();
    });

    big_bang_video.addEventListener('ended', function( e ) {
        change_background('{{ url('/img/chapter/big-bang-static.jpg') }}', 0);
        $("#big-bang-video").hide();

        $(".cientist").show();
        cientist('{{ trans('chapters.welcome.fala1') }}', 200);
        cientist('{{ trans('chapters.welcome.fala2') }}', 8000);

        setTimeout(function(){
            star_video.play();
            $("#stars-video").show();
            cientist('{{ trans('chapters.welcome.fala3') }}', 0);
        }, 16000);      
        
        setTimeout(
            function() {
                $(".cientist").hide('fast');
                $(".cientist-message").hide('fast');                
            }, 23000);
        
    }, false);

    /* ======================================== */
    /* PART II - Milk way */
    /* ======================================== */
    var milky_way = Popcorn("#milkway-video");
    var milky_way_video = document.getElementById("milkway-video");

    star_video_element.addEventListener('ended', function( e ) {
        $("body").removeAttr('style');
        
        $("#stars-video").hide();
        $(".cientist").show();
        cientist('{{ trans('chapters.welcome.fala4') }}', 800);
        $(".cientist-message").show();

         setTimeout(
            function() {
                $("#milkway-video").show();
                milky_way.play();
                cientist('{{ trans('chapters.welcome.fala5') }}', 8000);
        
            }, 12000);

         setTimeout(
            function() {
                $(".cientist").hide('fast');
                $(".cientist-message").hide('fast');   
        
            }, 22000);

    }, false);

    /* ======================================== */
    /* PART III - Sistema Solar */
    /* ======================================== */
    var solar = Popcorn("#solar-video");
    var solar_video_element = document.getElementById("solar-video");

    milky_way_video.addEventListener('ended', function( e ) {
        $("#milkway-video").hide();

        $(".cientist").show();
        solar.play();
        $("#solar-video").show();
        cientist('{{ trans('chapters.welcome.fala6') }}', 2000);
        $(".cientist-message").show();

    }, false);

    /* ======================================== */
    /* PART IV - TERRA */
    /* ======================================== */
    var terra = Popcorn("#terra-video");
    var terra_video_element = document.getElementById("terra-video");

    solar_video_element.addEventListener('ended', function( e ) {
        $("#solar-video").hide();

        $(".cientist").show();
        $("#terra-video").show();
        terra.play();
        cientist('{{ trans('chapters.welcome.fala7') }}', 2000);

    }, false);

    terra_video_element.addEventListener('ended', function( e ) {
        $("#terra-video").hide();
        $(".cientist").hide('fast');
        $(".cientist-message").hide('fast');


        // PRÓXIMO CAPÍTULO
        window.location = '{{ url('/game/tutorial') }}';
    }, false);
});
</script>
@stop

@section('content')
<video width="1366" id="big-bang-video" style="display:none" controls="false" preload>
    <source src="{{URL('/videos/big_bang.mp4')}}" type="video/mp4">
</video>

<video width="1366" id="stars-video" controls="false" style="display:none" preload>
    <source src="{{URL('/videos/astro_bp.mp4')}}" type="video/mp4">
</video>

<video width="1366" id="milkway-video" controls="false" style="display:none" preload>
    <source src="{{URL('/videos/milky_way.m4v')}}">
</video>

<video width="1366" id="solar-video" controls="false" style="display:none" preload>
    <source src="{{URL('/videos/sistema solar.mp4')}}">
</video>

<video width="1366" id="terra-video" controls="false" style="display:none" preload>
    <source src="{{URL('/videos/terra.mp4')}}">
</video>

<div class="uk-container uk-container-center game-section">
    <div class="uk-grid">
        <div class="uk-width-1-1 uk-text-center">
            <h1 class="uk-width-large-1-2 uk-width-medium-1-2 uk-align-center big-bang-text" style="color: #fff">{{ trans('chapters.welcome.start-text') }}</h1>
            <button class="uk-button-primary uk-button-large" id="big-bang"><i class="uk-icon-flask"></i> {{ trans('chapters.welcome.start-button') }}</button>
        </div>

        <div class="cientist-message" style="display:none">
            <div style="visibility: visible; display: block; opacity: 1;" class="uk-tooltip uk-tooltip-top">
                <div class="uk-tooltip-inner cientist-text"></div>
            </div>
        </div>
        <img src="{{ URL('/img/char/galileu.png')}}" class="cientist uk-animation-hover uk-animation-shake" alt="" style="display:none">
    </div>
</div>
@stop