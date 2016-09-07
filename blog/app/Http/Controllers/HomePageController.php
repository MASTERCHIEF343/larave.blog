<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
//model
use App\Tag;
//mark down
use EndaEditor;

class HomePageController extends Controller
{
	//variable
	protected $fields = [
	        'title' => '',
	        'page_image' => '',
	        'meta_description' => '',
	        'created_at' => '',
	];
	//index page
	public function index(){
		$tag = New Tag;
		$datas = [];
		$contents = $tag::all()->groupby('id');
		$contents = $contents->toArray();
		foreach (array_keys($contents) as $id) {
			$title = $tag::select('title')->where('id','=',$id)->first();
			$title = implode('', json_decode($title,true));
			$page_image = $tag::select('page_image')->where('id','=',$id)->first();
			$page_image = implode('', json_decode($page_image,true));
			$meta_description = $tag::select('meta_description')->where('id','=',$id)->first();
			$meta_description = implode('', json_decode($meta_description,true));
			$created_at = $tag::select('created_at')->where('id','=',$id)->first();
			$created_at = implode('', json_decode($created_at,true));
			$datas[$id]['id'] = $id;
			$datas[$id]['title'] = $title;
			$datas[$id]['page_image'] = $page_image;
			$datas[$id]['meta_description'] = $meta_description;
			$datas[$id]['created_at'] = $created_at;
		};
		return view('Home.index')->with('datas',$datas);
	}
	//msg page
	public function msg(){

	}
	//wiki page
	public function wiki(){

	}
	//poster introduction
	public function poster(){

	}
	//show msg
	public function showmsg($id){
		$tag = New Tag;
		$datas = [];
		$title = $tag::select('title')->where('id','=',$id)->first();
		$title = implode('', json_decode($title,true));
		$content = $tag::select('content')->where('id','=',$id)->first();
		$content = EndaEditor::MarkDecode(implode('', json_decode($content,true)));
		$created_at = $tag::select('created_at')->where('id','=',$id)->first();
		$created_at = implode('', json_decode($created_at,true));
		$datas[$id]['id'] = $id;
		$datas[$id]['title'] = $title;
		$datas[$id]['content'] = $content;
		$datas[$id]['created_at'] = $created_at;
		return view('Home.showmsg')->with('datas',$datas);
	}
}
