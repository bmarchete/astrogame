@extends('project.general')
@section('title') Astrogame Blog
@stop
@section('content')
<div class="thumbnav thumbnav-blog">
    <div class="uk-container uk-container-center">
        <h1>{{ $title }}</h1>
    </div>
</div>

<div class="white">
    <div class="uk-container uk-container-center blog">
        <div class="uk-grid uk-margin-large-top" data-uk-grid-margin>
            <div class="uk-width-medium-4-6 uk-panel uk-panel-box">
                @include('blog.loop')
            </div>

            <div class="uk-width-medium-2-6">
                @include('blog.sidebar')
            </div>
        </div>

        <hr class="uk-grid-divider">
    </div>
</div>
@stop