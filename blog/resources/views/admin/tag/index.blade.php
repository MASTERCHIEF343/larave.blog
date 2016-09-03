@extends('layouts.admintop')
	<!--nav-->
	@section('author-nav')
	<div  class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
			<li><a href="admin/post">发布</a></li>
			<li><a href="admin/tag">标签</a></li>
			<li><a href="admin/upload">更新</a></li>
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
				<div class="col-md-6 col-xs-6">
					<h3>标签 <small>» 列表</small></h3>
				</div>
				<div class="col-md-6 col-xs-6 text-right">
					<a href="admin/tag/create" class="btn btn-success btn-md">
						<i class="fa fa-plus-circle"></i> New Tag
					</a>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
				@include('admin.partials.errors')
				@include('admin.partials.success')
					<table id="tags-table" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>标签名</th>
								<th>标题</th>
								<th class="hidden-sm">副标题</th>
								<th class="hidden-md">标签介绍</th>
								<th class="hidden-md">模板</th>
								<th class="hidden-sm">Direction</th>
								<th data-sortable="false">Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($tags as $tag)
							<tr>
								<td>{{ $tag->tag }}</td>
								<td>{{ $tag->title }}</td>
								<td class="hidden-sm">{{ $tag->subtitle }}</td>
								<td class="hidden-md">{{ $tag->meta_description }}</td>
								<td class="hidden-md">{{ $tag->layout }}</td>
								<td class="hidden-sm">
									@if ($tag->reverse_direction)
									Reverse
									@else
									Normal
									@endif
								</td>
								<td>
									<a href="admin/tag/{{ $tag->id }}/edit" class="btn btn-xs btn-info">
										<i class="fa fa-edit"></i> Edit
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
	@section('scripts')
	    <script>
	        $(function() {
	            $("#tags-table").DataTable({
	            });
	        });
	    </script>
	@stop