@extends('project.general')
@section('title')
Blog
@stop

@section('content')
<div class="uk-container uk-container-center" style="padding-top: 200px">

<div class="uk-grid" data-uk-grid-margin>
    <h1>Blog Desastronautas</h1>
    <div class="uk-width-medium-4-4">
        @foreach ($posts as $post)
        <article class="uk-article">

            <h1 class="uk-article-title">
                <a href="layouts_post.html">{{ $post->title }}</a>
            </h1>

            <p class="uk-article-meta">Written by {{ $post->name }} on 12 April 2013. Posted in <a href="#">{{ $post->category }}</a></p>

            <p>
                <a href=""><img width="900" height="300" src="img/home-section3.jpg" alt=""></a>
            </p>

            {!! $post->content !!}

            <p>
                <a class="uk-button uk-button-primary" href="">Continuar lendo</a>
                <a class="uk-button" href="">4 Comments</a>
            </p>

        </article>
        @endforeach

        <ul class="uk-pagination">
            <li class="uk-disabled"><span><i class="uk-icon-angle-double-left"></i></span></li>
            <li class="uk-active"><span>1</span></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><span>...</span></li>
            <li><a href="#">20</a></li>
            <li><a href="#"><i class="uk-icon-angle-double-right"></i></a></li>
        </ul>

    </div>
</div>
</div>
<hr class="uk-grid-divider">
@stop