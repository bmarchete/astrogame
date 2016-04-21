<?php

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{

    /** 
	 * Todos os items devem ser colocados aqui
	 */
	public $posts = [
		
		[
			'title' => 'Júpiter sob a lua hoje!',
			'short_description' => 'Temos hoje uma maravilhosa vista no céu noturno, dê uma saidinha lá fora e veja o planeta Júpiter a olho nu, logo abaixo da lua!',
			'slug' => 'juptier-sob-a-lua-hoje',
			'content' => '<p>Temos hoje uma maravilhosa vista no céu noturno, dê uma saidinha lá fora e veja o planeta Júpiter a olho nu, logo abaixo da lua!</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>',
			'user_id' => 1,
			'category' => 'eventos',
		],

        [
            'title' => 'Júpiter sob a lua hoje!2',
            'short_description' => 'Temos hoje uma maravilhosa vista no céu noturno, dê uma saidinha lá fora e veja o planeta Júpiter a olho nu, logo abaixo da lua!',
            'slug' => 'juptier-sob-a-lua-hoje2',
            'content' => '<p>Temos hoje uma maravilhosa vista no céu noturno, dê uma saidinha lá fora e veja o planeta Júpiter a olho nu, logo abaixo da lua!</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>',
            'user_id' => 1,
            'category' => 'eventos',
        ],

        [
            'title' => 'Júpiter sob a lua hoje!3',
            'short_description' => 'Temos hoje uma maravilhosa vista no céu noturno, dê uma saidinha lá fora e veja o planeta Júpiter a olho nu, logo abaixo da lua!',
            'slug' => 'juptier-sob-a-lua-hoje3',
            'content' => '<p>Temos hoje uma maravilhosa vista no céu noturno, dê uma saidinha lá fora e veja o planeta Júpiter a olho nu, logo abaixo da lua!</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>',
            'user_id' => 1,
            'category' => 'eventos',
        ],

	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	foreach($this->posts as $post){
    		if(DB::table('posts')->where('title', $post['title'])->get() == null){
    			DB::table('posts')->insert($post);
    			echo '[ INFO ] Post: ' . e($post['title']) . " adicionado. \n";
    		}
    	}
    }
}
