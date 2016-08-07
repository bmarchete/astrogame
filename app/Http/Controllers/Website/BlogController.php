<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct()
    {
        foreach (wp_get_active_and_valid_plugins() as $plugin) {
            include_once $plugin;
        }

    }

    public function index()
    {
        $wordpress = new \WP_Query(array(
            'posts_per_page' => 20,
            'order' => 'ASC',
            'orderby' => 'post_title',
        ));

        $posts = $wordpress;

        return view('blog.index', ['wordpress' => $wordpress]);
    }

    public function single($slug)
    {
        $query = new \WP_Query(array(
            'name' => $slug,
            'post_type' => 'any',
        ));

        if ($query->have_posts()) {
            $query->the_post();

            return view('blog.single');
        } else {
            return 'post não encontrado';
        }
    }

    public function category($category)
    {
        $wordpress = new \WP_Query(array(
          'category' => $category,
        ));

        return view('blog.loop', ['wordpress' => $wordpress, 'title' => get_category_by_slug($category)->name]);
    }

    public function tag($tag)
    {
        $wordpress = new \WP_Query(array(
          'tag' => $tag,
        ));

        return view('blog.loop', ['wordpress' => $wordpress, 'title' => 'Posts com ' . $tag]);
    }

    public function search(Request $request)
    {
        $query = $request->q;
        $wordpress = new \WP_Query(array(
          's' => $query,
        ));

        return view('blog.loop', ['wordpress' => $wordpress, 'title' => 'Busca por '.$query]);
    }

    public function author($author)
    {
        $wordpress = new \WP_Query(array(
        'author' => $author,
      ));

        return view('blog.loop', ['wordpress' => $wordpress, 'title' => 'Posts de '.get_user_by('slug', $author)->data->display_name]);
    }
}
