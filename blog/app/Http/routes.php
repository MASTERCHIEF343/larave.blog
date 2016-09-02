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
	Route::get('admin/register','Admin\RegisterController@register');
	Route::get('admin/login','Admin\RegisterController@login');
	//after register
	Route::get('admin/user/{name}', 'Admin\RegisterController@user')->name('author');
	//logout
	Route::get('admin/logout','Admin\RegisterController@logout');
	//reset password
	Route::get('admin/password/reset','Admin\RegisterController@reset');

	//post
	//sin in
	Route::post('admin/sinin','Admin\RegisterController@sinin');
	//store new registers
	Route::post('admin/sinup','Admin\RegisterController@sinup');
	//send mail
	Route::post('admin/sendmail','Admin\RegisterController@sendmail');

	//Socialites
	Route::get('auth/github', 'SocialiteController@redirectToProvider');
	Route::get('auth/github/callback', 'SocialiteController@handleProviderCallback');

	//markdown
});
