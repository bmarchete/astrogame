@extends('project.general')
@section('title') {{ trans('blog.blog-full') }} @stop

@section('style')
{!! Minify::stylesheet('/vendor/uikit/css/components/search.gradient.css')!!}
@stop

@section('content')
<div class="blog-header">
    <div class="uk-container uk-container-center">
        <h1>{{ $post->title }}</h1>
    </div>
</div>
<div class="uk-container uk-container-center uk-margin-large-top blog">
    <div class="uk-grid" data-uk-grid-margin>
        <div class="uk-width-medium-3-4">
            <article class="uk-article">
                <h1 class="uk-article-title">{{ $post->title }}</h1>
                <p class="uk-article-meta">{{ trans('blog.written')}} <a href="{{ url('/player/' . $post->user_id)}}">{{ $post->name }}</a> on 12 April 2013. {{ trans('blog.category') }} <a href="{{ url('desastronautas/category/' . $post->category) }}">{{ $post->category }}</a></p>
                <p>
                    <img src="{{ url('img/blog/' . $post->img_url )}}" alt="{{ $post->title }}">
                </p>
                {!! $post->content !!}
            </article>
        </div>
        <div class="uk-width-medium-1-4">
            @include('blog.sidebar')
        </div>
    </div>
</div>
<hr class="uk-grid-divider">
@stop