@extends('project.general')
@section('title') {{ $title }} @stop
@section('content')
<div class="thumbnav thumbnav-blog">
    <div class="uk-container uk-container-center">
        <h1>{{ $title }}</h1>
    </div>
</div>

<div class="white">
<div class="uk-container uk-container-center blog">
    <div class="uk-grid uk-margin-large-top" data-uk-grid-margin>
        <div class="uk-width-medium-3-4">
            @if (!$wordpress->have_posts())
              <p>Não encontramos nenhum post relacionado :(</p>
            @else

            <?php if ( $wordpress->have_posts() ) : while ( $wordpress->have_posts() ) : $wordpress->the_post(); ?>
              <article class="uk-article" id="post-{{ the_ID() }}">
                  <h1 class="uk-article-title">
                    <a href="{{ url('blog/' . get_post_field('post_name', get_post()) ) }}">{{ the_title() }}</a>
                  </h1>
                  <p class="uk-article-meta">{{ trans('blog.written')}} <i class="uk-icon-user"></i> {!! the_author_posts_link() !!} em {{ the_time(get_option( 'date_format' )) }} | {{ trans('blog.category') }} <i class="uk-icon-inbox"></i> <a href="{{ url('desastronautas/category/') }}">{{ the_category( ', ' ) }}</a> | <i class="uk-icon-tags"></i> {{ the_tags()}}</p>

                  @if(has_post_thumbnail())
                    <figure class="uk-thumbnail">
                      {{ the_post_thumbnail() }}
                    </figure>
                  @endif

                  {!! the_content() !!}
              </article>
            <?php endwhile; endif; ?>
        @endif
    </div>

    <div class="uk-width-medium-1-4">
        @include('blog.sidebar')
    </div>
</div>

<hr class="uk-grid-divider">
</div>
</div>
@stop
