<?php

/*
|--------------------------------------------------------------------------
| Rotas da aplicação
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
| @author: Eduardo Augusto Ramos
|
*/

Route::group(['middleware' => 'web'], function () {
	// auth
	if(env('ASTROGAME_LOGIN')){
		Route::auth();
	}

	Route::group(['middleware' => 'website'], function(){
		// website-projeto
		Route::get('/', 'HomeController@index');
		Route::get('/home', 'HomeController@home');
		Route::get('/sobre', 'HomeController@sobre');
		Route::get('/equipe', 'HomeController@equipe');
		Route::get('/termos', 'HomeController@termos');
		Route::get('/politica', 'HomeController@politica');
		Route::get('/credits', 'HomeController@credits');

		// website-contact
		Route::get('/contato', 'ContactController@index');
		Route::post('/contato', 'ContactController@store');

		// public profile
		Route::get('/player/{nickname}', ['middleware'=> 'game', 'uses' => 'GameController@player'])->where('nickname', '[a-zA-Z0-9]+');
		Route::get('/ranking', 'HomeController@ranking');

		// blog
		Route::get('/blog', 'BlogController@index');
		Route::get('/blog/{slug}', 'BlogController@single')->where('slug', '[a-zA-z-]+');
		Route::get('/blog/category/{category}', 'BlogController@category')->where('category', '[a-zA-z-]+');
		Route::get('/blog/author/{author}', 'BlogController@author')->where('author', '[a-zA-z-]+');
		Route::get('/blog/tag/{tag}', 'BlogController@tag')->where('tag', '[a-zA-z-]+');
		Route::get('/blog/search', 'BlogController@search');

	});

	// website-game
	Route::group(['middleware' => ['auth', 'game'], 'prefix' => 'game'], function () {
		Route::get('/', 'GameController@index');
		Route::post('/report', 'ReportController@send');

		// quests
		Route::post('/quest_accept', 'QuestController@quest_accept');
		Route::post('/quest_cancel', 'QuestController@quest_cancel');
		Route::post('/quest_complete', 'QuestController@quest_complete');
		Route::get('/quest/{name}', 'QuestController@quest')->where('name', '[a-zA-Z0-9_]+');

		// item
		Route::post('/buy_item', 'ShopController@buy_item');
		Route::post('/remove_item', 'ShopController@remove_item');

		// general
		Route::get('/music/{volume}', 'AccountController@change_volume_music')->where('volume', '[0-9-]+');
		Route::get('/effects/{volume}', 'AccountController@change_volume_effects')->where('volume', '[0-9-]+');
		Route::get('/profile/{type}', 'AccountController@change_profile')->where('type', 'private|public');
		Route::get('/tutorial/{tutorial}', 'AccountController@change_tutorial')->where('tutorial', 'done|again');
		Route::get('/remove_avatar', 'AccountController@remove_avatar');
		Route::post('/change_account', 'AccountController@change_account');

	});

	// social login
	Route::get('/login/{provider}', 'SocialLoginController@login')->where('provider', '(facebook|google)');
	Route::get('/fallback/{provider}', 'SocialLoginController@fallback')->where('provider', '(facebook|google)');

	// confirm email
	Route::get('/confirm/verify/{confirm_code}', 'Auth\AuthController@confirmEmail');

	// language
	Route::get('/lang/{lang}', 'HomeController@change_language')->where('lang', '[a-z-]+');

	// chapters language
	Route::get('/falas/chapter/{chapter}', 'FalasController@getFromChapter');
});
