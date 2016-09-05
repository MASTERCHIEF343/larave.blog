<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//model
use App\Tag;
//encrypt
use Crypt;



class AdminController extends Controller
{
	//文章发布
	public function post(){

	} 
	//标签
	public function tag(Request $request){
		$name = Crypt::decrypt($request->session()->get('name'));
		$tags = Tag::all();
		return view('admin.tag.index')->with('name',$name)->withTags($tags);
	}
}
