@extends('layouts.admintop')
	<!--nav-->
	@section('author-nav')
	<div  class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
			<li><a href="home">首页</a></li>
			<li><a href="admin/tag">文章 </a></li>
			<li><a href="admin/upload">文件</a></li>
			<li><a href="admin/comment">评论</a></li>
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
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Login</div>
				<div class="panel-body">
					Welcome ,Master  {{ $name }}
				</div>
			</div>
		</div>
	@endsection