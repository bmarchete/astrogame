@if (!$wordpress->have_posts())
<p>Não encontramos nenhum post relacionado :(</p>
@else

<?php if ($wordpress->have_posts()) : while ($wordpress->have_posts()) : $wordpress->the_post(); ?>
  @include('blog.post')
<?php endwhile; endif; ?> @endif
