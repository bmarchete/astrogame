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
*/

Route::group(['middleware' => ['web']], function () {    
	// auth
	Route::auth();

	// website-projeto
	Route::get('/', 'HomeController@index');
	Route::get('/sobre', 'HomeController@sobre');
	Route::get('/equipe', 'HomeController@equipe');
	Route::get('/contato', 'HomeController@contato');
	Route::post('/contato', 'HomeController@enviar_contato');
	Route::get('/lang/{lang}', 'HomeController@change_language');
	Route::post('/bug', 'BugController@store');

	// implements
	Route::get('/termos', 'HomeController@termos');
	Route::get('/politica', 'HomeController@politica');

	// website-game
	Route::group(['middleware' => ['auth'], 'prefix' => 'game'], function () {    
		Route::get('/', 'GameController@index');
		Route::get('/observatory', 'GameController@observatory');
		
		// quests
		Route::get('/quest_accept/{id}', 'GameController@quest_accept');
		Route::get('/quest_cancel/{id}', 'GameController@quest_cancel');
		

		// general
		Route::get('/music/{volume}', 'GameController@change_volume_music')->where('volume', '[0-9-]+');
		Route::get('/effects/{volume}', 'GameController@change_volume_effects')->where('volume', '[0-9-]+');

	});

	// social login
	Route::get('/login/{provider}', 'SocialLoginController@login');
	Route::get('/fallback/{provider}', 'SocialLoginController@fallback');

});