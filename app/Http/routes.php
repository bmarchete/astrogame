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
	Route::get('/contato', 'HomeController@contato');
	Route::post('/contato', 'HomeController@enviar_contato');

	// website-game

	// social login
	Route::get('/login/{provider}', 'SocialLoginController@login');
	Route::get('/fallback/{provider}', 'SocialLoginController@fallback');

});