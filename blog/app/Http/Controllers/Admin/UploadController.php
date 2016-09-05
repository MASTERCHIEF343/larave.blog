<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//uploadprodivers
use App\Services\UploadsManager;
//crypt
use Crypt;
//filesystem request
use App\Http\Requests\UploadFileRequest;
use App\Http\Requests\UploadNewFolderRequest;
use Illuminate\Support\Facades\File;
//
use Storage;


class UploadController extends Controller
{
	protected $manager;

	public function __construct(UploadsManager $manager){
		$this->manager = $manager;
	}
	//更新 
	public function upload(Request $request){
		$name = Crypt::decrypt($request->session()->get('name'));
		$folder = $request->get('folder');
	         $data = $this->manager->folderInfo($folder);
		return view('admin.upload.upload',$data)->with('name',$name);
	}
	//create 文件
	public function createfile(UploadFileRequest $request){

	}
	//delete 文件
	public function deletefile(Request $request){
		$del_file = $request->get('del_file');
		Storage::disk('local')->delete($del_file);

	}
	//upload 目录
	public function createfolder(UploadNewFolderRequest $request){
		
	}
	//delete 目录
	public function deletefolder(Request $request){

	}
}
