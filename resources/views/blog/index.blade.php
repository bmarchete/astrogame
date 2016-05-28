@extends('project.general')
@section('title') {{ $title }} {{ trans('blog.blog-full') }} @stop

@section('style')
{!! Minify::stylesheet('/vendor/uikit/css/components/search.gradient.css')!!}
@stop

@section('content')
<div class="blog-header">
    <div class="uk-container uk-container-center">
        <h1>Desastronautas</h1>
    </div>
</div>
<div class="uk-container uk-container-center uk-margin-large-top blog">
    <div class="uk-grid" data-uk-grid-margin>
        <div class="uk-width-medium-3-4">
            @if (empty($posts->first())) Não encontramos nenhum post relacionado :( @else @foreach ($posts as $post)
            <article class="uk-article">
                <h1 class="uk-article-title">
                <a href="{{ url('/desastronautas/post/' . $post->slug) }}">{{ $post->title }}</a>
            </h1>
                <p class="uk-article-meta">{{ trans('blog.written')}} <a href="{{ url('/player/' . $post->user_id)}}">{{ $post->name }}</a> em {{ $post->created_at}}. {{ trans('blog.category') }} <a href="{{ url('desastronautas/category/' . $post->category) }}">{{ $post->category }}</a></p>
                <p>
                    <a href="{{ url('desastronautas/post/' . $post->slug) }}"><img src="{{ url('img/blog/' . $post->img_url )}}" alt="{{ $post->title }}"></a>
                </p>
                {!! $post->short_description !!}
                <p>
                    <a class="uk-button uk-button-primary" href="{{ url('desastronautas/post/' . $post->slug) }}">Continuar lendo</a>
                </p>
            </article>
            @endforeach
            <ul class="uk-pagination">
                @if ($posts->currentPage() == 1)
                <li class="uk-disabled"><span><i class="uk-icon-angle-double-left"></i><span></li>
            @else
                <li><a href="{{ $posts->previousPageUrl() }}"><i class="uk-icon-angle-double-left"></i></a></li>
            @endif

            @for ($page = 1; $page < $posts->total(); $page++)
                @if ($posts->currentPage() == $page)
                    <li class="uk-active"><span>{{$page}}</span></li>
                @else @if ($posts->hasMorePages())
                <li><a href="{{ $posts->url($page) }}">{{$page}}</a></li>
                @endif @endif @endfor @if ($posts->hasMorePages())
                <li><a href="{{ $posts->nextPageUrl() }}"><i class="uk-icon-angle-double-right"></i></a></li>
                @else
                <li class="uk-disabled"><span><i class="uk-icon-angle-double-right"></i><span></li>
            @endif
        </ul>

        @endif
    </div>

    <div class="uk-width-medium-1-4">
        @include('blog.sidebar')
    </div>
</div>
</div>
<hr class="uk-grid-divider">
@stop
