@extends('layouts.homeheader')
	<!--link-->
	@section('link')
	<link rel="stylesheet" type="text/css" href="../resources/assets/css/main-content.css">
	@endsection
	<!--Nav-->
	@section('nav')
	<ul class="nav navbar-nav menu ">
		<li class="nav-current"><a href="home">首页</a></li>
		<li role="presentation" class="dropdown">
			<a class="dropdown-toggle link-color" data-toggle="dropdown" href="msg">
				分类 <span class="caret"></span>
			</a>
			<ul class="dropdown-menu" role="menu">
				@foreach ($array as $arr)
				<li><a href="tag/{{$arr}}">{{$arr}}</a></li>
				@endforeach
			</ul>
		</li>
		<li><a href="wiki">wiki</a></li>
		<li><a href="poster">作者</a></li>
	</ul>
	@endsection
	<!--content-->
	@section('content')
	<div class="main-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8 left-content" >
					@foreach ($datas as $data)
						<article class="article">
							<div class="post-header">
								<h1>{{$data['title']}}</h1>
								<div class="post-meta">
									<span class="author">作者: <a href="poster">{{$data['name']}} </a></span> |
									<time class="post-date">时间: {{$data['created_at']}}</time>
								</div>
							</div>
								<div class="post-pic">
									<img src="uploads/Img/{{$data['page_image']}}">
								</div>
							<div class="post-descripition">
								{{$data['meta_description']}}
							</div>
							<div class="post-button">
								<a href="msg/{{$data['id']}}" class="link">阅读全文</a>
							</div>
							<footer class="post-footer">
								<div class="pull-left">
									<img src="img/doc.png">
								</div>
							</footer>
						</article>
					@endforeach
				</div>
				<div class="col-md-4 right-content">
					<div class="widget">
						<h4 class="title"><img src="img/mineblog2.png" style="height:30px;"></h4>
						<div class="content">
							<p>
								<h4>Motto:  </h4>
								<i>Somewhere beyond right and wrong thereis a garden,I will meet you there.</i>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="PageIndex">
			<div class="row">
				<div class="col-md-12">
					{!! $tag->links() !!}
				</div>
			</div>
		</div>
	</div>
	@endsection
