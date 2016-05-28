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

            <hr class="uk-grid-divider">

            <section class="comments">
                <h2>Comments</h2>
                <div id="disqus_thread"></div>
                <script>
                    /**
                     *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                     *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
                     */
                    /*
                    var disqus_config = function () {
                        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                    };
                    */
                    (function() {  // DON'T EDIT BELOW THIS LINE
                        var d = document, s = d.createElement('script');
                        
                        s.src = '//desastronautas.disqus.com/embed.js';
                        
                        s.setAttribute('data-timestamp', +new Date());
                        (d.head || d.body).appendChild(s);
                    })();
                </script>
                <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
            </section>
        </div>

        <div class="uk-width-medium-1-4">
            @include('blog.sidebar')
        </div>
    </div>
</div>
<hr class="uk-grid-divider">
@stop