@extends('project.general')
@section('title') {{ the_title() }} - Astrogame Blog @stop
@section('content')
<div class="blog">
<div class="thumbnav">
    <div class="uk-container uk-container-center">
        <h1>{{ the_title() }}</h1>
    </div>
</div>
<div class="white">
<div class="uk-container uk-container-center uk-margin-large-top blog">
    <div class="uk-grid uk-margin-large-top" data-uk-grid-margin>
        <div class="uk-width-medium-3-4">
          <article class="uk-article" id="post-{{ the_ID() }}">
              <h1 class="uk-article-title">{{ the_title() }}</h1>
              <p class="uk-article-meta">{{ trans('blog.written')}} {!! the_author_posts_link() !!} em {{ the_date() }}. {{ trans('blog.category') }} <a href="{{ url('desastronautas/category/') }}">{{ the_category( ', ' ) }}</a></p>
              {!! the_content() !!}
              <p>
                  <a class="uk-button uk-button-primary" href="{{ the_permalink() }}">Continuar lendo</a>
              </p>
          </article>
          <hr class="uk-grid-divider">

          

          <div id="disqus_thread"></div>
            <script>

            /**
             *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
             *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables */

            var disqus_config = function () {
                //this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                //this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                this.language = "pt";
            };

            (function() { // DON'T EDIT BELOW THIS LINE
                var d = document, s = d.createElement('script');
                s.src = '//astrogame.disqus.com/embed.js';
                s.setAttribute('data-timestamp', +new Date());
                (d.head || d.body).appendChild(s);
            })();
            </script>
            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    </div>

    <div class="uk-width-medium-1-4">

    </div>
</div>
</div>
<hr class="uk-grid-divider">
</div>
@stop
