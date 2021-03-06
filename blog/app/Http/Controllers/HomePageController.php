<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
//model
use App\Tag;
//mark down
use EndaEditor;
use DB;
//model visitor
use App\Visitor;
//rss
use Suin\RSSWriter\Channel;
use Suin\RSSWriter\Feed;
use Suin\RSSWriter\Item;
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
		$tag =Tag::paginate(2);
		$contents = $tag->toArray();
		$contents = end($contents);
		foreach ($contents as $ids) {
			$id = $ids['id'];
			$title = Tag::select('title')->where('id','=',$id)->first();
			$title = implode('', json_decode($title,true));
			$name = Tag::select('name')->where('id','=',$id)->first();
			$name = implode('', json_decode($name,true));
			$page_image = Tag::select('page_image')->where('id','=',$id)->first();
			$page_image = implode('', json_decode($page_image,true));
			$meta_description = Tag::select('meta_description')->where('id','=',$id)->first();
			$meta_description = implode('', json_decode($meta_description,true));
			$created_at = Tag::select('created_at')->where('id','=',$id)->first();
			$created_at = implode('', json_decode($created_at,true));
			$datas[$id]['id'] = $id;
			$datas[$id]['title'] = $title;
			$datas[$id]['name'] = $name;
			$datas[$id]['page_image'] = $page_image;
			$datas[$id]['meta_description'] = $meta_description;
			$datas[$id]['created_at'] = $created_at;
		};
		$Tags = Tag::select('tag')->get()->toArray();
		foreach ($Tags as $key => $value) {
			$array[] =  $value['tag'];
		}
		return view('Home.index',['datas'=>$datas,'tag'=>$tag,'array'=>$array]);
	}
	//wiki page
	public function wiki(){

	}
	//poster introduction
	public function poster(){
		$Tags = Tag::select('tag')->get()->toArray();
		foreach ($Tags as $key => $value) {
			$array[] =  $value['tag'];
		}
		return view('Home.poster',['array'=>$array]);
	}
	//show msg
	public function showmsg($id){
		$tag = New Tag;
		$msgindex = $id;
		$datas = [];
		$title = $tag::select('title')->where('id','=',$id)->first();
		$title = implode('', json_decode($title,true));
		$name = $tag::select('name')->where('id','=',$id)->first();
		$name = implode('', json_decode($name,true));
		$content = $tag::select('content')->where('id','=',$id)->first();
		$content = EndaEditor::MarkDecode(implode('', json_decode($content,true)));
		$created_at = $tag::select('created_at')->where('id','=',$id)->first();
		$created_at = implode('', json_decode($created_at,true));
		$datas[$id]['id'] = $id;
		$datas[$id]['title'] = $title;
		$datas[$id]['name'] = $name;
		$datas[$id]['content'] = $content;
		$datas[$id]['created_at'] = $created_at;
		return view('Home.showmsg',['datas'=>$datas,'msgindex'=>$msgindex]);
	}
	//show different tags
	public function showdiffertags($tags){
		$tag =Tag::where('tag' ,'=' ,$tags)->paginate(2);
		$contents = $tag->toArray();
		$contents = end($contents);
		foreach ($contents as $ids) {
			$id = $ids['id'];
			$title = Tag::select('title')->where('id','=',$id)->first();
			$title = implode('', json_decode($title,true));
			$name = Tag::select('name')->where('id','=',$id)->first();
			$name = implode('', json_decode($name,true));
			$page_image = Tag::select('page_image')->where('id','=',$id)->first();
			$page_image = implode('', json_decode($page_image,true));
			$meta_description = Tag::select('meta_description')->where('id','=',$id)->first();
			$meta_description = implode('', json_decode($meta_description,true));
			$created_at = Tag::select('created_at')->where('id','=',$id)->first();
			$created_at = implode('', json_decode($created_at,true));
			$datas[$id]['id'] = $id;
			$datas[$id]['title'] = $title;
			$datas[$id]['name'] = $name;
			$datas[$id]['page_image'] = $page_image;
			$datas[$id]['meta_description'] = $meta_description;
			$datas[$id]['created_at'] = $created_at;
		};
		$Tags = Tag::select('tag')->get()->toArray();
		foreach ($Tags as $key => $value) {
			$array[] =  $value['tag'];
		}
		return view('Home.showdiffertags',['datas'=>$datas,'tags'=>$tags,'tag'=>$tag,'array'=>$array]);
	}
	//rss
	public function rss(){
		$num = DB::table('tags')->orderBy('created_at', 'desc')->count();
		$len = $num;
		$msgs = DB::table('tags')->orderBy('created_at', 'desc')->get();
		$lastest = $msgs[$len-1];

		$feed = new Feed();
		$channel = new Channel();
		$channel
		    ->title('MasterChief\'s Blog')
		    ->description('With great power comes great responsibility.')
		    ->url('http://MasterChief\'s Blog.com')
		    ->language('zn-CH')
		    ->copyright('Copyright 2012, Foo Bar')
		    ->pubDate(strtotime('Tue, 21 Sep 2016 19:50:37 +0900'))
		    ->appendTo($feed);

		// Blog item
		$item = new Item();
		$item
		    ->title($lastest->title)
		    ->description('<div>'.$lastest->subtitle.'</div>')
		    ->contentEncoded('<div>'.$lastest->content.'</div>')
		    ->url('http://blog.example.com/2012/08/21/blog-entry/')
		    ->author('MasterChief')
		    ->pubDate(strtotime($lastest->created_at))
		    ->preferCdata(true) // By this, title and description become CDATA wrapped HTML.
		    ->appendTo($channel);

		return response($feed)->header('Content-type', 'text/xml');;
	}
}
