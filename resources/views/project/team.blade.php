@extends('project.general')
@section('title') {{ trans('project.team') }} | {{ trans('project.project-name') }} @stop
@section('content')
<div class="team">
<div class="uk-container uk-container-center uk-margin-large-bottom">
    <div class="uk-grid team-section" data-uk-grid-margin>
        <div class="uk-width-1-1 uk-text-center">
            <h1>{{ trans('project.team') }}</h1>
            <h2>{{ trans('project.team-pre-text') }}</h2>
        </div>
    </div>
    <div class="uk-grid" data-uk-grid-margin>
        @foreach ($team as $member)
        <div class="uk-width-medium-1-5 uk-text-center">
            <div class="uk-thumbnail uk-overlay-hover uk-border-circle">
                <figure class="uk-overlay">
                    <img class="uk-border-circle" width="250" height="250" src="{{ $member->img }}" alt="">
                    <figcaption class="uk-overlay-panel uk-overlay-background uk-flex uk-flex-center uk-flex-middle uk-text-center uk-border-circle">
                        <div>
                            @if (!empty($member->facebook))
                            <a href="{{ $member->facebook }}" class="uk-icon-button uk-icon-facebook"></a>
                            @endif @if (!empty($member->twitter))
                            <a href="{{ $member->twitter }}" class="uk-icon-button uk-icon-twitter"></a>
                            @endif @if (!empty($member->instagram))
                            <a href="{{ $member->instagram }}" class="uk-icon-button uk-icon-instagram"></a>
                            @endif @if (!empty($member->devianart))
                            <a href="{{ $member->devianart }}" class="uk-icon-button uk-icon-deviantart"></a>
                            @endif @if (!empty($member->github))
                            <a href="{{ $member->github }}" class="uk-icon-button uk-icon-github"></a>
                            @endif @if (!empty($member->blog))
                            <a href="{{ url('/desastronautas/author/') . '/' . $member->author_blog }}" class="uk-icon-button uk-icon-pencil"></a>
                            @endif
                        </div>
                    </figcaption>
                </figure>
            </div>
            <h2 class="uk-margin-top">{{ $member->name }}</h2>
            <p class="uk-text-large">{{ $member->description }}</p>
        </div>
        @endforeach
    </div>
</div>
<div class="uk-grid uk-container uk-container-center" data-uk-grid-margin>
    <div class="uk-width-1-1 uk-width-large-2-4">
        <h1>{{ trans('project.team-about') }}</h1> {!! trans('project.team-text') !!}
    </div>
    <div class="uk-width-1-1 uk-width-large-2-4">
        <div class="uk-thumbnail uk-overlay-hover ">
            <figure class="uk-overlay">
                <img src="img/home-section4.jpg" alt="">
                <figcaption class="uk-text-center uk-overlay-panel uk-overlay-background uk-flex uk-flex-center uk-flex-middle"> {{ trans('project.team-figcaption')}} </figcatipon>
            </figure>
        </div>
    </div>
</div>
</div>@stop
