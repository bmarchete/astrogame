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
        $posts = Post::select('posts.id', 'posts.title', 'posts.short_description', 'posts.category', 'posts.created_at', 'posts.slug', 'user_id')
                     ->paginate(10);

        return view('blog.index', ['title' => '', 'posts' => $posts]);
    }

    public function page(Request $request){
        $page = $request->page;
        
    }

    public function single_post(Request $request){
        $slug = $request->slug;

        $post = Post::select('posts.id', 'posts.title', 'posts.content', 'posts.category', 'posts.created_at', 'posts.slug', 'user_id', 'users.name')
                     ->join('users', 'posts.user_id', '=', 'user_id')
                     ->where('slug', $slug)
                     ->limit(1)
                     ->get()
                     ->first();

        return view('blog.single-post', ['post' => $post]);

    }

    public function category(Request $request){
        $category = $request->category;

        $posts = Post::select('posts.id', 'posts.title', 'posts.short_description', 'posts.category', 'posts.created_at', 'posts.slug', 'user_id')
                     ->where('category', '=', $category)
                     ->paginate(10);

        return view('blog.index', ['title' => $category . ' | ', 'posts' => $posts]);
    }

    public function search(Request $request){
        $search = $request->search;

        $posts = Post::select('posts.id', 'posts.title', 'posts.short_description', 'posts.category', 'posts.created_at', 'posts.slug', 'user_id', 'users.name')
                     ->join('users', 'posts.user_id', '=', 'user_id')
                     ->where('title', 'LIKE', "%$search%")
                     ->orWhere('short_description', 'LIKE', '%$search%')
                     ->paginate(10);

        return view('blog.index', ['title' => $search . ' | ', 'posts' => $posts]);
    }

    public function author(Request $request){
        $author = $request->author;

        $posts = Post::select('posts.id', 'posts.title', 'posts.short_description', 'posts.category', 'posts.created_at', 'posts.slug', 'user_id')
                     ->where('user_id', $author)
                     ->paginate(10);

        return view('blog.index', ['title' => $author . ' | ', 'posts' => $posts]);
    }
}
