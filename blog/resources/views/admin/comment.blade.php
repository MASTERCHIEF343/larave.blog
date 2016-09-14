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
			<div class="row page-title-row">
				<div class="col-md-12 col-xs-12">
					<h3>评论 <small>» 列表</small></h3>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
				@include('admin.partials.errors')
				@include('admin.partials.success')
					<table id="tags-table" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>id</th>
								<th>文章id</th>
								<th>姓名</th>
								<th>邮箱</th>
								<th>个人主页</th>
								<th>评论</th>
								<th>发布时间</th>
								<th data-sortable="false">Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($comments as $comm)
							<tr>
								<td>{{ $comm['id'] }}</td>
								<td>{{ $comm['msg_id'] }}</td>
								<td>{{ $comm['nickname'] }}</td>
								<td>
									@if ($comm['email']))
									    {{ $comm['email'] }}
									@else
									    None
									@endif
								</td>
								<td>
									@if ($comm['personalweb']))
									    {{ $comm['personalweb'] }}
									@else
									    None
									@endif
								</td>
								<td>{{ $comm['comment'] }}</td>
								<td>{{ $comm['created_at'] }}</td>
								<td>
									<a href="admin/comment/{{ $comm['id'] }}/delete" class="btn btn-xs btn-danger">
										<i class="fa fa-times-circle"></i> Delete
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	@endsection