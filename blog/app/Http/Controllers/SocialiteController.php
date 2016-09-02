<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
//model
use App\User;
//encrypt
use Crypt;
//mail
use Mail;
//socialite
use Socialite;

class SocialiteController extends Controller
{
	//Socialite 社会化登录认证 Github
	/**
	 * 将用户重定向到GitHub认证页面.
	 *
	 * @return Response
	 */
	public function redirectToProvider()
	{
		return Socialite::driver('github')->redirect();
	}

	/**
	 * 从GitHub获取用户信息.
	 *@param Request $request
	 * @return Response
	 */
	public function handleProviderCallback(Request $request)
	{
		$user = Socialite::driver('github')->user();
		// save and log in
		if(User::where('name',$user->getName())->get()){
			$name = Crypt::encrypt($user->getName());
			$request->session()->put('name',$name);
			return redirect()->route('author',$name);
		}else if(!User::where('github_id',$user->getId())->first()){
			$userModel = new User;
			$userModel->name = $user->getName();
			$userModel->email = $user->getEmail();
			$userModel->rank = 'admin';
			$userModel->save();
			$name = Crypt::encrypt($user->name);
			$request->session()->put('name',$name);
			return redirect()->route('author',$name);
		}else{
			return view('register.login',['err' => 'Your github has been registed.']);
		}
	}
}
