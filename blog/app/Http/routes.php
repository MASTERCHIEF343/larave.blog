<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

	//get
	Route::get('register','BlogController@register');
	Route::get('login','BlogController@login');
	//after register
	Route::get('user/{name}', 'BlogController@user')->name('author');
	//logout
	Route::get('logout','BlogController@logout');
	//reset password
	Route::get('password/reset','BlogController@reset');

	//post
	//sin in
	Route::post('sinin','BlogController@sinin');
	//store new registers
	Route::post('sinup','BlogController@sinup');
	//send mail
	Route::post('/sendmail','BlogController@sendmail');
});
