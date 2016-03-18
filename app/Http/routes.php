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
	});

	// social login
	Route::get('/login/{provider}', 'SocialLoginController@login');
	Route::get('/fallback/{provider}', 'SocialLoginController@fallback');

});