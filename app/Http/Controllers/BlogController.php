<?php

namespace AstroGame\Http\Controllers;

use Illuminate\Http\Request;

use AstroGame\Http\Requests;
use AstroGame\Post;
use Carbon\Carbon;

class BlogController extends Controller
{
    public function index(){
    	//$posts = Post::select('id', 'title', 'category', 'content')->join('users', 'posts.user_id', '=', 'users.id')->limit(5)->get();
    	$posts = [
    		(object) ['id' => 1,
    				'title' => 'Teste',
    				'content' => 'teste',
    				'category' => 'teste',
    				'name' => 'Edu'],
    	];
    	return view('blog.index', ['posts' => $posts]);
    }
}
