<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
//model
use App\Tag;

class SearchController extends Controller
{
	public function index(Request $request){
		$data = $request->all();
		$data = $data['search-object'];
		$results = Tag::where('title','like','%'.$data.'%')->get();

		return response()->json($results);
	}
}
