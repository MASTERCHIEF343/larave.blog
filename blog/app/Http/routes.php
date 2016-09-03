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


	//admin-post
	Route::get('admin/post','Admin\AdminController@post');
	//admin-tags
	Route::get('admin/tag','Admin\AdminController@tag');
	//admin-upload
	Route::get('admin/upload','Admin\AdminController@upload');

	//create new tag
	Route::get('admin/tag/create','Admin\TagController@create');
	//edite tag
	Route::get('admin/tag/{id}/edit' ,'Admin\TagController@edit');



	//post
	//sin in
	Route::post('admin/sinin','Admin\RegisterController@sinin');
	//store new registers
	Route::post('admin/sinup','Admin\RegisterController@sinup');
	//send mail
	Route::post('admin/sendmail','Admin\RegisterController@sendmail');
	//store new tag
	Route::post('admin/tag/store','Admin\TagController@storetag');
	//update tag
	Route::post('admin/tag/update/{id}','Admin\TagController@update');
	//delete tag
	Route::post('admin/tag/delete/{id}','Admin\TagController@delete');


	//Socialites
	Route::get('auth/github', 'SocialiteController@redirectToProvider');
	Route::get('auth/github/callback', 'SocialiteController@handleProviderCallback');

	//markdown
});
