@extends('layouts.homeheader')
	<!--link-->
	@section('link')
	<link rel="stylesheet" type="text/css" href="../resources/assets/css/main-msg.css">
	@endsection
	<!--Nav-->
	@section('nav')
	<ul class="nav navbar-nav menu ">
		<li><a href="home">首页</a></li>
		<li class="nav-current"><a href="javascript:void();">文章</a></li>
		<li><a href="wiki">wiki</a></li>
		<li><a href="poster">作者</a></li>
	</ul>
	@endsection
	<!--content-->
	@section('content')
		<div class="msg-box">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12 msg-box">
						@foreach ($datas as $data)
							<article class="article">
								<div class="post-header">
									<h1>{{$data['title']}}</h1>
									<div class="post-meta">
										<span class="author">作者: <a href="poster">{{$data['name']}}</a></span> |
										<time class="post-date">时间:  {{$data['created_at']}}</time>
									</div>
								</div>
								<div class="msg-content">
									@include('editor::decode')
									{!! $data['content'] !!}
								</div>
								<div id="comment-place">
									<div class="panel panel-info">
										<div class="panel-heading">
											<h3 class="panel-title">评论</h3>
										</div>
										<div class="panel-body">
											<div>
												<ul id="box">
												</ul>
											</div>
										</div>
										<div class="panel-footer">
											<form id="form">
												{!! csrf_field() !!}
												<div class="form-group">
													<input type="text" name="nickname" id="nickname">
													<label for="nickname" >
														昵称
													</label>
												</div>
												<div class="form-group">
													<input type="email" name="email" id="email">
													<label for="email" >
														邮件地址 (选填)
													</label>
												</div>
												<div class="form-group">
													<input type="text" name="personalweb" id="personalweb">
													<label for="personalweb" >
														个人主页 (选填)
													</label>
												</div>
												<div class="form-group">
													<textarea name="comment" rows="8" style="width:500px;resize:none;" ></textarea>
												</div>
												<!-- Indicates a successful or positive action -->
												<button type="button" id="submit" class="btn btn-success">发表评论</button>
											</form>
										</div>
									</div>
								</div>
							</article>
						@endforeach
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			//show comment
			$(document).ready(function(){
				var comments = $.get("comment/upload/{{$msgindex}}",function(data){
					var ul = document.getElementById('box');
					for (var i = 0; i < data.length; i++) {
						var comments = document.createElement('div');
						comments.className = 'comments';
						var commentsimg = document.createElement('img');
						commentsimg.src = 'img/user.png';
						commentsimg.className = 'comments-img';
						comments.appendChild(commentsimg);
						//coments-box
						var commentsbox = document.createElement('div');
						commentsbox.className = 'comments-box';
						//name
						var commentsname = document.createElement('span');
						commentsname.className = 'comments-name';
						commentsname.innerHTML = data[i]['nickname'];
						commentsbox.appendChild(commentsname);
						//content
						var commentscontent = document.createElement('p');
						commentscontent.className = 'comments-content';
						commentscontent.innerHTML = data[i]['comment'];
						commentsbox.appendChild(commentscontent);
						//time
						var commentstime = document.createElement('time');
						commentstime.className = 'comments-time';
						commentstime.innerHTML = data[i]['created_at'];
						commentsbox.appendChild(commentstime);
						//added
						comments.appendChild(commentsbox);
						ul.appendChild(comments);
					}
				});
				//post comment
				$('#submit').click(function(){
					var formParam = $("#form").serialize();
					var datas = $.ajax({
						url: "comment/upload/{{$msgindex}}",
						type: 'post',
						data: formParam,
						headers: {
						       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
						success: function(data){
							$('#myModal').modal(true);
							$('#btn').click(function(){
								location.reload();
							});
						},
						error : function() {  
						// view("异常！");  
							console.log("异常！");
						}  
					});
				});
			});
		</script>
	@endsection

<div class="modal fade" id="myModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Success</h4>
			</div>
			<div class="modal-body">
				<p>发表成功 !</p>
			</div>
			<div class="modal-footer">
				<button type="button" id="btn" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->