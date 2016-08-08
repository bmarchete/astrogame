<aside class="uk-panel uk-panel-box">
    <form role="search" method="get" class="uk-form" action="{{ url('/blog/search')}}" data-uk-search>
        <div class="uk-form-icon uk-display-block uk-margin-bottom">
            <i class="uk-icon-search"></i>
            <input type="search" class="uk-width-1-1" name="s" placeholder="Procuro por...">
        </div>
    </form>

    <div class="uk-panel uk-margin-large-top">
        <h3 class="uk-panel-title">Últimos posts</h3>
        <ul class="uk-list-line" style="list-style: none; margin: 0; padding: 0">
                <?php while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?>
                <li>
                    <a href="{{ the_permalink() }}" rel="bookmark">
                        {{ the_title() }}
                    </a>
                </li>
                <?php endwhile; ?>
        </ul>
    </div>

    <div class="uk-panel uk-margin-large-top">
        <h3 class="uk-panel-title">Categorias</h3>
        <ul class="uk-list-line" style="list-style: none; margin: 0; padding: 0">
            <?php $categories = get_categories(); ?>
            <?php foreach ($categories as $category): ?>
            <li><a href="<?= url('/blog/category').'/'.$category->slug ?>" rel="bookmark"><?= $category->name ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="uk-panel uk-margin-large-top">
        <h3 class="uk-panel-title">Anúncios</h3>
        <figure class="uk-thumbnail">
            <img src="{{ url('img/large-box.png')}}" alt="">
        </figure>
    </div>

    <div class="uk-panel uk-margin-large-top">
        <h3 class="uk-panel-title">Social</h3>
        <figure class="uk-thumbnail">
            <img src="{{ url('img/large-box.png')}}" alt="">
        </figure>
    </div>
</aside>
