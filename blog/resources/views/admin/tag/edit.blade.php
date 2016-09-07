@extends('layouts.admintop')
	<!--nav-->
	@section('author-nav')
	<div  class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
			<li><a href="home">首页</a></li>
			<li><a href="admin/tag">文章 </a></li>
			<li><a href="admin/upload">文件</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
					{{ $name }}
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="{{ url('admin/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
				</ul>
			</li>
		</ul>
	</div>
	@endsection
	<!--content-->
	@section('author-content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>标签 <small>» edit</small></h3>
					</div>
					<div class="panel-body">
						@include('admin.partials.success')
						<form class="form-horizontal" role="form" method="POST" action="admin/tag/update/{{ $id }}" enctype="multipart/form-data">
							{!! csrf_field() !!}
							@include('admin.partials.errors')
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<label for="tag" class="col-md-3 control-label">Tag</label>
									<div class="col-md-6">
										<p class="form-control-static">{{ $tag }}</p>
									</div>
								</div>
							</div>
							@include('admin.tag.form')
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary btn-md">
									<i class="fa fa-save"></i>
									Save Changes
									</button>
									<button type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#modal-delete">
									<i class="fa fa-times-circle"></i>
									Delete
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	{{-- 确认删除 --}}
	<div class="modal fade" id="modal-delete" tabIndex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
					×
					</button>
					<h4 class="modal-title">Please Confirm</h4>
				</div>
				<div class="modal-body">
					<p class="lead">
						<i class="fa fa-question-circle fa-lg"></i>
						你确定删除这个标签吗?
					</p>
				</div>
				<div class="modal-footer">
					<form class="form-horizontal" role="form" method="POST" action="admin/tag/delete/{{ $id }}">
						{!! csrf_field() !!}
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-danger">
						<i class="fa fa-times-circle"></i> Yes
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	@endsection