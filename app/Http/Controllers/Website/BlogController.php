<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cache;
use WP_Query;

class BlogController extends Controller
{
    public function __construct()
    {
        foreach (wp_get_active_and_valid_plugins() as $plugin) {
            include_once $plugin;
        }

        $recentPosts = new WP_Query();
        $recentPosts->query('showposts=10');

        view()->composer('project.general', function ($view) {
            $view->with('page', 'blog');
        });

        view()->composer('blog.sidebar', function ($view) use ($recentPosts) {
            $view->with('recentPosts', $recentPosts);
        });
    }

    public function index()
    {
        $wordpress = Cache::remember('blog_index', 5, function () {
          return new WP_Query(
            [
              'posts_per_page' => 20,
              'order' => 'ASC',
              'orderby' => 'post_title',
            ]);
          }
        );

        return view('blog.index', ['wordpress' => $wordpress, 'title' => 'Desastronautas']);
    }

    public function single($slug)
    {
        $query = Cache::remember('blog_slug_'.$slug, 5, function () use ($slug) {
          return new WP_Query(
            [
              'name' => $slug,
              'post_type' => 'any',
            ]);
          }
        );

        if ($query->have_posts()) {
            $query->the_post();

            return view('blog.single');
        } else {
            return 'post não encontrado';
        }
    }

    public function category($category)
    {
        $wordpress = Cache::remember('blog_category'.$category, 5, function () use ($category) {
            return new WP_Query(['category' => $category]);
          }
        );

        return view('blog.index', ['wordpress' => $wordpress, 'title' => get_category_by_slug($category)->name]);
    }

    public function tag($tag)
    {
        $wordpress = new WP_Query(['tag' => $tag]);

        return view('blog.index', ['wordpress' => $wordpress, 'title' => 'Posts com '.$tag]);
    }

    public function search(Request $request)
    {
        $wordpress = new WP_Query(['s' => $request->s]);

        return view('blog.index', ['wordpress' => $wordpress, 'title' => 'Busca por '.$query]);
    }

    public function author($author)
    {
        $wordpress = Cache::remember('blog_author'.$author, 5, function () use ($author) {
            return new WP_Query(['author' => $author]);
          }
        );

        return view('blog.index', ['wordpress' => $wordpress, 'title' => 'Posts de '.get_user_by('slug', $author)->data->display_name]);
    }
}
