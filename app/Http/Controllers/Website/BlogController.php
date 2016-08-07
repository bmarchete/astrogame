<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class BlogController extends Controller
{
    public function __construct(){
      foreach ( wp_get_active_and_valid_plugins() as $plugin ){
        include_once( $plugin );
      }
    }

    public function index(){
        $wordpress = new \WP_Query(array(
            'posts_per_page' => 20,
            'order' => 'ASC',
            'orderby' => 'post_title',
        ));

        $posts = $wordpress;

        return view('blog.index', ['wordpress' => $wordpress]);
    }

    public function single($slug){

        $query = new \WP_Query(array(
            'name' => $slug,
            'post_type' => 'any'
        ));

        if($query->have_posts()){
          $query->the_post();
          return view('blog.single');
        } else {
          return "post não encontrado";
        }


    }

    public function category($category){

    }

    public function search($query){

    }

    public function author($author){

    }
}
