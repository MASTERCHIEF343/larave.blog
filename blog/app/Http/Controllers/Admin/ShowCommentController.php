<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//model 
use App\Visitor;
//encrypt
use Crypt;

class ShowCommentController extends Controller
{
	//show comments
	public function comment(Request $request){
		$name = Crypt::decrypt($request->session()->get('name'));
		$comment = New Visitor;
		$comments = $comment::all();
		return view('admin.comment',['name'=>$name,'comments'=>$comments]);
	}
	public function delete($id){
		$com = New Visitor;
		$child = $com::where('parent_id','=',$id)->delete();
		$msg = $com::where('id','=',$id)->delete();
		return redirect('admin/comment')->withSuccess("The comment '$id ' was deleted.");
	}
}
