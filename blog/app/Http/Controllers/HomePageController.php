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
		return view('Home.index');
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
