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

Route::group(['middleware' => ['web']], function () {    
	// auth
	Route::auth();

	// website-projeto
	Route::get('/', 'HomeController@index');
	Route::get('/home', 'HomeController@home');
	Route::get('/sobre', 'HomeController@sobre');
	Route::get('/equipe', 'HomeController@equipe');
	Route::get('/contato', 'HomeController@contato');
	Route::get('/termos', 'HomeController@termos');
	Route::get('/politica', 'HomeController@politica');

	// website-blog
	Route::get('/desastronautas', 'BlogController@index');
	Route::get('/desastronautas/{page}', 'BlogController@page')->where('page', '[0-9]+');
	Route::get('/desastronautas/category/{category}', 'BlogController@category')->where('category', '[a-z-]+');
	Route::get('/desastronautas/post/{slug}', 'BlogController@single_post');
	Route::get('/desastronautas/search', 'BlogController@search');
	Route::get('/desastronautas/author/{author}', 'BlogController@author')->where('author', '[0-9]+');

	// post
	Route::post('/contato', 'HomeController@enviar_contato');
	Route::post('/bug', 'BugController@store');
	Route::get('/lang/{lang}', 'HomeController@change_language')->where('lang', '[a-z-]+');
	
	// public profile
	Route::get('/player/{id}', 'GameController@player')->where('id', '[0-9]+');
	Route::get('/ranking', 'GameController@ranking');

	// website-game
	Route::group(['middleware' => ['auth'], 'prefix' => 'game'], function () {    
		Route::get('/', 'ChapterController@index');
		Route::get('/campaign', 'GameController@index');
		Route::get('/exploration', 'ExplorationController@index');
		Route::get('/observatory', 'ObservatoryController@index');
		Route::get('/map', 'GameController@campaing_map');

		// quests
		Route::get('/quest_accept/{id}', 'QuestController@quest_accept')->where('id', '[0-9-]+');
		Route::get('/quest_cancel/{id}', 'QuestController@quest_cancel')->where('id', '[0-9-]+');
		Route::get('/quest/{id}', 'QuestController@quest')->where('id', '[0-9-]+');

		// item
		Route::get('/buy_item/{id}', 'ShopController@buy_item')->where('id', '[0-9-]+');
		Route::get('/remove_item/{id}', 'ShopController@remove_item')->where('id', '[0-9-]+');

		// general
		Route::get('/music/{volume}', 'AccountController@change_volume_music')->where('volume', '[0-9-]+');
		Route::get('/effects/{volume}', 'AccountController@change_volume_effects')->where('volume', '[0-9-]+');

		// chapters
		Route::get('/chapter_complete/{key}', 'ChapterController@chapter_complete')->where('key', '[a-z-]+');
		Route::get('/welcome', 'ChapterController@welcome');
		Route::get('/tutorial', 'ChapterController@tutorial');
		Route::get('/chapter1', 'ChapterController@chapter1');
		Route::get('/chapter2', 'ChapterController@chapter2');
		
	});

	// social login
	Route::get('/login/{provider}', 'SocialLoginController@login')->where('provider', '[a-z-]+');
	Route::get('/fallback/{provider}', 'SocialLoginController@fallback')->where('provider', '[a-z-]+');
});