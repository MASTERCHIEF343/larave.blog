<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<base href="http://localhost/blog/public/">
	<meta name="author" content="masterchief">
	<meta name="description" content="personal blog">
	<meta name="theme" content="HomePage">
	<title>Anonymous's Blog</title>
	<!-- 新 Bootstrap 核心 CSS 文件 -->
	<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
	<!-- 可选的Bootstrap主题文件（一般不用引入） -->
	<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="../resources/assets/css/homepage.css">
	@section('link')
	@show
	<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
	<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>
	<!--Header-->
	<header class="main-header" style="background:url('img/bg.jpg');">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h1 id="page-header">
						<span>With great power comes great responsibility.</span>
					</h1>
					<span>一个小而有爱的博客</span>
				</div>
			</div>
		</div>
	</header>
	<!--nav-->
	<nav class="main-navigation navbar navbar-default" role="navigation">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"></a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse " id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav menu ">
					<li class="nav-current"><a href="home">首页</a></li>
					<li><a class="link-color" href="msg">文章</a></li>
					<li><a href="wiki">wiki</a></li>
					<li><a href="poster">作者</a></li>
				</ul>
				<form class="navbar-form navbar-right " role="search">
					<div class="form-group">
						<input type="text" id="form-search" class=" form-control " placeholder="想要找些什么呢....">
					</div>
					<a href="javascript:void();">
						<img class="nav-img" src="img/search.png">
					</a>
				</form>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
	<!--Content-->
	@section('content')
	@show
	<!--Footer-->
	<footer class="footer">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<span>
						Copyright &copy; 
						1995 - 2016
					</span>
					|
					<span>
						Created by 
						<a class="outlink" href="https://github.com/MASTERCHIEF343">
							Master Chief
						</a>
					</span>
				</div>
			</div>
		</div>
	</footer>
</body>
<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</html>