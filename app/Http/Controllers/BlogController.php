<?php

namespace AstroGame\Http\Controllers;

use Illuminate\Http\Request;

use AstroGame\Http\Requests;
use AstroGame\Post;
use Carbon\Carbon;

class BlogController extends Controller
{
    public function index(){
    	return $this->list_posts();
    }

    private function list_posts($page = 1){
        //$posts = Post::select('id', 'title', 'category', 'content')->join('users', 'posts.user_id', '=', 'users.id')->limit(5)->get();
        $posts = [
            (object) ['id' => 1,
                    'title' => 'Teste',
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>',
                    'category' => 'teste',
                    'link' => 'teste-post-1',
                    'name' => 'Edu'],


        ];
        return view('blog.index', ['posts' => $posts]);
    }

    public function page(Request $request){
        $page = $request->page;
        
    }

    public function single_post(Request $request){
        $post = $request->post;

    }

    public function category(Request $request){

    }

    public function search(Request $request){

    }

    public function author(Request $request){
        $author = $request->author;

    }
}
