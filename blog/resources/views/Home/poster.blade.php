@extends('layouts.homeheader')
	<!--link-->
	@section('link')
	<link rel="stylesheet" type="text/css" href="../resources/assets/css/poster.css">
	@endsection
	<!--Nav-->
	@section('nav')
	<ul class="nav navbar-nav menu ">
		<li><a href="home">首页</a></li>
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
		<li class="nav-current"><a href="poster">作者</a></li>
	</ul>
	@endsection
	<!--content-->
	@section('content')
		<div class="main-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-8 left-content" >
						<div class="poster-photo">
							<article class="article">
								<div class="poster-box">
									<img src="img/poster.jpg" alt="mine" id="poster-img">
								</div>
								<div class="poster-tag">
									<span class="label label-default">PHP</span>
									<span class="label label-primary">JS</span>
									<span class="label label-success">学生党</span>
									<span class="label label-info">电影控</span>
									<span class="label label-warning">迷茫</span>
									<span class="label label-danger">安静</span>
								</div>
								<div class="poster-msg">
									<h3>Open your eyes, open your mind.</h3>
									<img alt="open" src="img/open.jpg">
								</div>
							</article>
						</div>
					</div>
					<div class="col-md-4 right-content">
						<div class="widget">
							<h4 class="title">个人链接</h4>
							<div class="content">
								<a href="https://github.com/MASTERCHIEF343">
									<img alt="github" src="img/github.png">
								</a>
								<a href="https://segmentfault.com/u/masterchief343">
									<img alt="segmentfault" src="img/sf.jpg" style="height:27px;width:27px;border-radius:50%;">
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endsection