@extends('project.general')
@section('title') {{ the_title() }} - Astrogame Blog @stop

@section('content')
<div class="thumbnav thumbnav-blog">
    <div class="uk-container uk-container-center">
        <h1>{{ the_title() }}</h1>
    </div>
</div>

<div class="white">
<div class="uk-container uk-container-center">
    <div class="uk-grid uk-margin-large-top" data-uk-grid-margin>
        <div class="uk-width-medium-4-6">
          <article id="post-<?php the_ID(); ?>" <?php post_class(array('uk-article')); ?>>

            <?php
            if (is_single()) {
                the_title('<h1 class="uk-article-title">', '</h1>');
            } else {
                the_title('<h1 class="uk-article-title"><a href="'.esc_url(get_permalink()).'" class="uk-link-reset" rel="bookmark">', '</a></h1>');
            }
            ?>
            <p class="uk-article-meta">
                <?php printf(
                    '<span class="nst-author uk-link-reset"><a href="%1$s" rel="author"><i class="uk-icon-user"></i> %2$s</a></span>',
                    esc_url(get_author_posts_url(get_the_author_meta('ID'))),
                    get_the_author()
                ); ?>
                <?php printf(
                    '<span class="nst-entry-time uk-margin-small-left"><i class="uk-icon-clock-o"></i> <time datetime="%1$s">%2$s</time></span>',
                    esc_attr(get_the_date('c')),
                    esc_html(get_the_date())
                ); ?>
                <span class="nst-category-list uk-margin-small-left uk-link-reset">
                    <i class="uk-icon-ticket"></i> <?php echo get_the_category_list(', '); ?>
                </span>
                <?php if (!post_password_required() && (comments_open() || get_comments_number())) : ?>
                    <span class="nst-comments uk-margin-small-left uk-link-reset">
                        <?php comments_popup_link(
                            '<i class="uk-icon-comment"></i> '.__('Leave a comment'), '<i class="uk-icon-comment"></i> 1', '<i class="uk-icon-comment"></i> %'); ?>
                    </span>
                <?php endif; ?>
                <?php edit_post_link('<i class="uk-icon-edit"></i> '.__('Edit'), '<span class="nst-edit-link uk-margin-small-left uk-link-reset">', '</span>'); ?>
                <?php if (is_single()) : ?>
                    <br/ >
                    <?php the_tags('<span class="nst-tag-list uk-link-reset"><i class="uk-icon-tag"></i> ', ', ', '</span>'); ?>
                <?php endif; ?>
            </p>

            @if(has_post_thumbnail())
              <figure class="uk-thumbnail">
                {{ the_post_thumbnail() }}
              </figure>
            @endif


            <?php if (is_search()) : ?>
                <div class="nst-entry-summary">
                    <?php the_excerpt(); ?>
                </div><!-- .entry-summary -->
            <?php else : ?>
                <div class="nst-entry-content">
                    <?php
                    the_content('Continue reading <span class="meta-nav">&rarr;</span>');
                    //            wp_link_pages( array(
                    //                'before'      => '<div class="page-links"><span class="page-links-title">Pages</span>',
                    //                'after'       => '</div>',
                    //                'link_before' => '<span>',
                    //                'link_after'  => '</span>',
                    //            ) );
                    ?>
                </div><!-- .entry-content -->
            <?php endif; ?>

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

    <div class="uk-width-medium-2-6">
        @include('blog.sidebar')
    </div>
</div>
</div>
<hr class="uk-grid-divider">
</div>
@stop
