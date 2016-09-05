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
		$file = $_FILES['file'];
		$filename = $request->get('file_name');
		$filename = $filename ? : $file['name'];
		$filepath = str_finish($request->get('folder'), '/').'/'.$filename;
		$content = File::get($file['tmp_name']);
		$result = $this->manager->saveFile($filepath,$content);
		if($result === true){
			return redirect()->back()->withSuccess("File '$filename' created.");
		}
		$error = $result ? : "An error occurred create file.";
		return redirect()->back()->withErrors([$error]);
	}
	//delete 文件
	public function deletefile(Request $request){
		$del_file = $request->get('del_file');
		$path = $request->get('folder').'/'.$del_file;

		$result = $this->manager->deleteFile($path);

		if ($result === true) {
			return redirect()->back()->withSuccess("File '$del_file' deleted.");
		}

		$error = $result ? : "An error occurred delete file.";
		return redirect()->back()->withErrors([$error]);
	}
	//create 目录
	public function createfolder(UploadNewFolderRequest $request){
		$new_folder = $request->get('new_folder');
		$folder = $request->get('folder').'/'.$new_folder;
		$result = $this->manager->createDirectory($folder);
		if($result === true){
			return redirect()->back()->withSuccess("Folder '$new_folder' created. ");
		}
		$error = $result ? : "An error occurred create folder.";
		return redirect()->back()->withErrors([$error]);
	}
	//delete 目录
	public function deletefolder(Request $request){
		$filename = $request->get('del_folder');
		$folder = $request->get('folder').'/'.$filename;
		$result = $this->manager->deleteDirectory($folder);
		if($result === true){
			return redirect()->back()->withSuccess("Folder '$filename' deleted. ");
		}
		$error = $result ? : "An error occurred delete folder.";
		return redirect()->back()->withErrors([$error]);
	}
}
