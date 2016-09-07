@extends('layouts.homeheader')
	<!--link-->
	@section('link')
	<link rel="stylesheet" type="text/css" href="../resources/assets/css/main-content.css">
	@endsection
	<!--content-->
	@section('content')
	<div class="main-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8 left-content" >
					<article class="article">
						<div class="post-header">
							<h1>Test</h1>
							<div class="post-meta">
								<span class="author">作者: <a href="poster">Masterchief </a></span> |  
								<time class="post-date">时间: 2016-09-07</time>
							</div>
						</div>
						<div class="post-pic">
							<img src="img/protal.jpg">
						</div>
						<div class="post-descripition">
							<p>Laravel 项目组自豪地宣布 Laravel 5.3 正式发布了 ！5.3 版本中的新增特性主要集中在提升开发速度，通过增强常见任务的开箱即用功能提升开发效率。 此版本是常规发布版本，提供六个月的 bug 修复补丁和一年的安全补丁。当前，Laravel 5.1 是最新的 LTS（长期支持） 版本，提供两年的 bug</p>
						</div>
						<div class="post-button">
							<a href="#" class="link">阅读全文</a>
						</div>
					</article>
					<article class="article">
						<div class="post-header">
							<h1>Test</h1>
							<div class="post-meta">
								<span class="author">作者: <a href="poster">Masterchief </a></span> |  
								<time class="post-date">时间: 2016-09-07</time>
							</div>
						</div>
						<div class="post-pic">
							<img src="img/protal.jpg">
						</div>
						<div class="post-descripition">
							<p>Laravel 项目组自豪地宣布 Laravel 5.3 正式发布了 ！5.3 版本中的新增特性主要集中在提升开发速度，通过增强常见任务的开箱即用功能提升开发效率。 此版本是常规发布版本，提供六个月的 bug 修复补丁和一年的安全补丁。当前，Laravel 5.1 是最新的 LTS（长期支持） 版本，提供两年的 bug</p>
						</div>
						<div class="post-button">
							<a href="#" class="link">阅读全文</a>
						</div>
					</article>
				</div>
				<div class="col-md-4 right-content">
					<div class="widget">
						<h4 class="title">源码地址</h4>
						<div class="content">
							<p>Github: </p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection