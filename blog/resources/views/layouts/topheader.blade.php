<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Anoymous's Blog</title>
		<base href="http://localhost/blog/public/">
		<meta name="author" content="masterchief">
		<meta name="description" content="personal blog">
		<meta name="theme" content="topheader">
		<!--网站图标-->
		<link rel="shortcut icon" href="../public/img/protal.jpg">
		<!-- 新 Bootstrap 核心 CSS 文件 -->
		<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<!--font-->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
		<link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
		<style type="text/css">
			.fa-btn{
				margin-right: 6px;
			}
			body {
			    font-family: 'Lato';
			}
		</style>
	</head>
	<body>
		<!--Header.nav-->
		<nav class="navbar navbar-default">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="javascript:void(0);">Back-end</a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				@if(Session::get('name'))
					@section('author-nav')
					@show
				@else
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="login">Login</a></li>
						<li><a href="register">Register</a></li>
				</div><!-- /.navbar-collapse -->
				@endif
			</div><!-- /.container-fluid -->
		</nav>

		<!--Form-->
		@section('form')
		@show
		<!--when author logged in-->
		@if(Session::get('name'))
			@section('author-content')
			@show
		@endif		
	</body>
	<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
	<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	</html>