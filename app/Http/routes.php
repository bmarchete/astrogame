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
	Route::get('/sobre', 'HomeController@sobre');
	Route::get('/equipe', 'HomeController@equipe');
	Route::get('/contato', 'HomeController@contato');
	Route::get('/termos', 'HomeController@termos');
	Route::get('/politica', 'HomeController@politica');

	Route::post('/contato', 'HomeController@enviar_contato');
	Route::post('/bug', 'BugController@store');
	Route::get('/lang/{lang}', 'HomeController@change_language')->where('lang', '[a-z-]+');
	
	// public profile
	Route::get('/player/{id}', 'GameController@player')->where('id', '[0-9]+');
	Route::get('/ranking', 'GameController@ranking');

	// website-game
	Route::group(['middleware' => ['auth'], 'prefix' => 'game'], function () {    
		Route::get('/', 'GameController@index');
		Route::get('/campaign', 'GameController@index');
		Route::get('/exploration', 'GameController@exploration');
		Route::get('/observatory', 'GameController@observatory');
		
		// chapter
		Route::get('/chapter_complete/{key}', 'GameController@chapter_complete')->where('key', '[a-z-]+');

		// quests
		Route::get('/quest_accept/{id}', 'GameController@quest_accept')->where('id', '[0-9-]+');
		Route::get('/quest_cancel/{id}', 'GameController@quest_cancel')->where('id', '[0-9-]+');
		Route::get('/quest/{id}', 'GameController@quest');

		// item
		Route::get('/buy_item/{id}', 'GameController@buy_item')->where('id', '[0-9-]+');
		Route::get('/remove_item/{id}', 'GameController@remove_item')->where('id', '[0-9-]+');

		// general
		Route::get('/music/{volume}', 'GameController@change_volume_music')->where('volume', '[0-9-]+');
		Route::get('/effects/{volume}', 'GameController@change_volume_effects')->where('volume', '[0-9-]+');

		// chapters
		Route::get('/welcome', 'GameController@welcome');
		Route::get('/tutorial', 'GameController@tutorial');
		Route::get('/chapter1', 'GameController@chapter1');
		
	});

	// social login
	Route::get('/login/{provider}', 'SocialLoginController@login')->where('provider', '[a-z-]+');
	Route::get('/fallback/{provider}', 'SocialLoginController@fallback')->where('provider', '[a-z-]+');
});