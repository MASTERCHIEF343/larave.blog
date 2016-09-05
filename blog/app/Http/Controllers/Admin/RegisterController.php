<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//request
use  App\Http\Requests\StoreNewauthorRequest;
//model
use App\User;
use App\Rank;
//encrypt
use Crypt;
//mail
use Mail;
//socialite
use Socialite;
//BroadCast
use Event;
use App\Events\PusherEvent;
class RegisterController extends Controller
{
	use AuthenticatesAndRegistersUsers, ThrottlesLogins;
	/*
	*middleware
	*@ return void
	*/
	// public function __construct(){
	// 	//strict  times
	// 	$this->middleware('throttle:30 ,1');
	// }
	//显示登录界面
	public function index(){
		return view();
	}
	//登录页面
	public function login(){
		return view('admin.login');
	}
	/**
	 * 登录方法
	 *
	 * @param  StoreNewauthorRequest  $request
	 * @return Response
	 */
	public function sinin(StoreNewauthorRequest $request){
		$user = New User;
		$email = User::where('email','=',$request->email)->select('password')->first();
		if($email){
			$passwd = Crypt::decrypt($email->password);
			$requestpasswd = $request->password;
			if($passwd == $requestpasswd){
				$name = User::where('email','=',$request->email)->select('name')->first();
				$name =  Crypt::encrypt($name->name);
				$request->session()->put('name',$name);
				return redirect()->route('author',$name);
			}else{
				return view('admin.login',['err'=>'Your password is wrong !']);
			}
		}else{
			return view('admin.login',['err'=>'Your email is not exsits !']);
		}
	}
	//注册页面
	public function register(){
		return view('admin.register');
	}
	/*
	*注册方法
	*@param Request $request
	*@return Response
	*/
	public function sinup(Request $request){
		// 验证并存储
		$this->validate($request,[
			'name' => 'bail|required|max:255|unique:users',
			'email' => 'bail|required|email|max:255|unique:users',
			'password' => 'bail|required|confirmed|min:6'
		]);
		//sotre
		$user = New User;
		$user->name = $request->name;
		$user->email = $request->email;
		$user->rank = 'admin';
		$user->password = Crypt::encrypt($request->password);
		$name = Crypt::encrypt($request->name);
		//session
		if($user->save()){
			$request->session()->put('name',$name);
			return redirect()->route('author',$name);
		}else{
			abort(401);
		}
	}
	/*
	*检测是否有author
	*@param Request $request
	*@return Response
	*/
	public function user(Request $request){
		if($request->session()->has('name')){
			$username = Crypt::decrypt($request->session()->get('name'));
			return view('admin.user')->with('name',$username);
		}else{
			abort(401);
		}
	}
	//登出
	public function logout(Request $request){
		$request->session()->pull('name');
		return redirect('admin/login');
	}
	//密码忘记
	public function reset(){
		return view('admin.reset');
	}
	/*
	*发送邮件重置密码
	*@param Request $request
	*@return Response
	*/
	public function sendmail(Request $request){
		$this->validate($request,[
			'email' => 'bail|required|email|max:255',
		]);
		$user = New User;
		if($email = User::where('email','=',$request->email)->first()){
			$sendTo = $email->email;
			$name = 'Masterchief';
			//生成新的密码
			$newpasswd = substr(md5(time()),0, 8);
			User::where('email','=',$request->email)->update(['password'=>Crypt::encrypt($newpasswd)]);
			$mail = Mail::queue('email.email',['email'=>$sendTo,'name'=>$name,'newpasswd'=>$newpasswd],function($message) use($sendTo,$name,$newpasswd) {
				$message->to($sendTo,$name)->subject('密码更改');
			});
			return redirect('admin/login');
		}else{
			return view('admin.reset',['err'=>'Your email is not exsits !']);
		}
	}
}
