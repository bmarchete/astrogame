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
	Route::auth();

	// website-projeto
	Route::group(['middleware' => 'website'], function(){
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
		Route::get('/player/{id}', ['middleware'=> 'game', 'uses' => 'GameController@player'])->where('id', '[0-9]+');
		Route::get('/ranking', 'HomeController@ranking');
	});

	// website-game
	Route::group(['middleware' => ['auth', 'game'], 'prefix' => 'game'], function () {
		Route::get('/', 'ChapterController@index');
		Route::post('/report', 'ReportController@send');

		// quests
		Route::get('/quest_accept/{id}', 'QuestController@quest_accept')->where('id', '[0-9-]+');
		Route::get('/quest_cancel/{id}', 'QuestController@quest_cancel')->where('id', '[0-9-]+');
		Route::get('/quest/{id}', 'QuestController@quest')->where('id', '[0-9-]+');
		Route::get('/quest_complete/{id}', 'QuestController@quest_complete')->where('id', '[0-9-]+');


		// item
		Route::get('/buy_item/{id}', 'ShopController@buy_item')->where('id', '[0-9-]+');
		Route::get('/remove_item/{id}', 'ShopController@remove_item')->where('id', '[0-9-]+');

		// general
		Route::get('/music/{volume}', 'AccountController@change_volume_music')->where('volume', '[0-9-]+');
		Route::get('/effects/{volume}', 'AccountController@change_volume_effects')->where('volume', '[0-9-]+');
		Route::get('/profile/{type}', 'AccountController@change_profile')->where('type', 'private|public');
		Route::post('/change_account', 'AccountController@change_account');

		// chapters
		Route::get('/chapter_complete/{key}', 'ChapterController@chapter_complete')->where('key', '[a-z-]+');
		Route::get('/welcome', 'ChapterController@welcome');
		Route::get('/tutorial', 'ChapterController@tutorial');
		Route::get('/chapter1', 'ChapterController@chapter1');
		Route::get('/chapter2', 'ChapterController@chapter2');

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
