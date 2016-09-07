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
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>标签 <small>» adding</small></h3>
					</div>
					<div class="panel-body">
						<form class="form-horizontal" role="form" method="POST" action="admin/tag/store">
							{!! csrf_field() !!}
							@include('admin.partials.errors')
							<div class="form-group">
								<label for="tag" class="col-md-4 control-label">标签</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="tag" id="tag" value="{{ $tag }}" autofocus>
								</div>
							</div>
							@include('admin.tag.form')
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary btn-md">
									<i class="fa fa-plus-circle"></i>
									添加标签
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection
	@section('scripts')
	    <script>
	        $(function() {
	            $("#tags-table").DataTable({
	            });
	        });
	    </script>
	@stop