<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//encrypt
use Crypt;
//request
use  App\Http\Requests\TagCreateStore;
use  App\Http\Requests\TagUpdateRequest;
//model
use App\Tag;

class TagController extends Controller
{
	//variable
	protected $fields = [
	        'tag' => '',
	        'title' => '',
	        'subtitle' => '',
	        'meta_description' => '',
	        'page_image' => '',
	        'layout' => 'blog.layouts.index',
	        'reverse_direction' => 0,
	];

	//create 标签
	public function create(Request $request){
		$name = Crypt::decrypt($request->session()->get('name'));
		$data = [];
		foreach ($this->fields as $field => $default) {
		            $data[$field] = old($field, $default);
	         }
		return view('admin.tag.create',$data)->with('name',$name);
	}
	//store 
	public function storetag(TagCreateStore $request){
		$tag = New Tag();
		foreach (array_keys($this->fields) as $field) {
		        $tag->$field = $request->get($field);
		}
		$tag->save();
		return redirect('admin/tag')->withSuccess("The tag '$tag->tag' was created.");
	}
	//edite
	public function edit(Request $request,$id){
		$name = Crypt::decrypt($request->session()->get('name'));
		$tag = Tag::findOrFail($id);
		$data = ['id' => $id];
		foreach (array_keys($this->fields) as $field) {
			$data[$field] = old($field, $tag->$field);
		}
		return view('admin.tag.edit',$data)->with('name',$name); 	
	}
	//update 
	public function update(TagUpdateRequest $request,$id){
		$tag = Tag::findOrFail($id);
		//remove tag because tag exisits.
		foreach (array_keys(array_except($this->fields, ['tag'])) as $field) {
		        $tag->$field = $request->get($field);
		}
		$tag->save();
		return redirect('admin/tag')->withSuccess("Changes saved.");
	}
	//delte 
	public function delete($id){
		$tag = Tag::findOrFail($id);
		$tag->delete();
		return redirect('admin/tag')->withSuccess("The tag '$tag->tag' was deleted.");
	}

}
