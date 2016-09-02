<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use EndaEditor;
class EditorController extends Controller
{
	public function editor(){
		return view('Editor.editor');
	}
}
