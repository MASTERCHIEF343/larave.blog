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

	//home page
	Route::get('home','HomePageController@index');
	Route::get('msg','HomePageController@msg');
	Route::get('wiki','HomePageController@wiki');
	Route::get('poster','HomePageController@poster');
	//show msg
	Route::get('msg/{id}','HomePageController@showmsg');
	//show different tags
	Route::get('tag/{tags}','HomePageController@showdiffertags');


	//get
	//register and log in
	Route::get('admin/register','Admin\RegisterController@register');
	Route::get('admin/login','Admin\RegisterController@login');
	//after register
	Route::get('admin/ser/{name}', 'Admin\RegisterController@user')->name('author');
	//logout
	Route::get('admin/logout','Admin\RegisterController@logout');
	//reset password
	Route::get('admin/password/reset','Admin\RegisterController@reset');

	//admin-post
	Route::get('admin/post','Admin\AdminController@post');
	//admin-tags
	Route::get('admin/tag','Admin\AdminController@tag');
	//admin-upload
	Route::get('admin/upload','Admin\UploadController@upload');

	//create new tag
	Route::get('admin/tag/create','Admin\TagController@create');
	//edite tag
	Route::get('admin/tag/{id}/edit' ,'Admin\TagController@edit');
	//delete msg
	Route::get('admin/tag/{id}/delete','Admin\TagController@delete');


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
	//create content
	Route::post('admin/tag/update/{id}/createcontent','Admin\TagController@createcontent');

	//filesystem
	//upload file
	Route::post('admin/upload/createfile','Admin\UploadController@createfile');
	//delete file
	Route::delete('admin/upload/deletefile','Admin\UploadController@deletefile');
	//create folder
	Route::post('admin/upload/createfolder','Admin\UploadController@createfolder');
	//delete folder
	Route::delete('admin/upload/deletefolder','Admin\UploadController@deletefolder');


	//Socialites
	Route::get('auth/github', 'SocialiteController@redirectToProvider');
	Route::get('auth/github/callback', 'SocialiteController@handleProviderCallback');

});
