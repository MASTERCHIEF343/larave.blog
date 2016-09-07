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
	//index page
	public function index(){
		$tag = New Tag;
		$content = EndaEditor::MarkDecode("#我是markdown语法");
		return view('Home.index')->with('content',$content);
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
}
