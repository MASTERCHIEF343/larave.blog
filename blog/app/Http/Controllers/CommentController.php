<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
//model
use App\Visitor;

class CommentController extends Controller
{
	//store comment
	public function storecomment(Request $request ,$id){
		$visitor = New Visitor;
		$visitor->msg_id = $id;
		if($request->parent_id){
			$visitor->parent_id = $request->parent_id;
		}else{
			$visitor->parent_id = 0;
		}
		$visitor->nickname = $request->nickname;
		$visitor->comment = $request->comment;
		$visitor->save();
		return response()->json();
	}
	//show comment
	public function showcomment($id){
		$model = 'visitors';
		$cms = getcomments($model);
		return response()->json($cms);
	}
}
