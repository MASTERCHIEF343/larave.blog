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
										<div class="panel-body"  id="cms">
											
										</div>
										<div class="panel-footer">
											<div class="form-box">
												<form id="form" enctype="multipart/form-data">
													{!! csrf_field() !!}
													<input type="text" name="parent_id" id="parent_id" value="" hidden="hidden">
													<div class="form-group">
														<input type="text" name="nickname" id="nickname">
														<label for="nickname" >
															昵称
														</label>
													</div>
													<div class="form-group">
														<input type="email" name="email" id="email">
														<label for="email" >
															邮箱(选填)
														</label>
													</div>
													<div class="form-group">
														<input type="text" name="personalweb" id="personalweb">
														<label for="personalweb" >
															个人主页(选填)
														</label>
													</div>
													<div class="form-group">
														<textarea name="comment" id="commenttextarea" rows="8" style="width:80%;resize:none;" ></textarea>
													</div>
													<!-- Indicates a successful or positive action -->
													<button type="button" id="submit" class="btn btn-success submit">发表评论</button>
												</form>
											</div>
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
				$.get("comment/upload/{{$msgindex}}",function(data){
					var len = data.length;
					for (var i = 0; i < len; i++) {
						tree = commentstree(data[i]);
						var Cms = document.getElementById('cms');
						Cms.appendChild(tree);
					};
				});
			});
			//post comment
			$('.panel').delegate("button","click",function(){
				var nickname = this.parentNode.children['2'].children['0'].value;
				var comment = this.parentNode.children['5'].children['0'].value;
				if(nickname == ''){
					alert('昵称不能为空!');
					return false;
				}
				if(comment == ''){
					alert('评论不能为空!');
					return false;
				}
				formid = "#" + this.parentNode.id;
				var formParam = $(formid).serialize();
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
			//reply display
			$('.panel-body').delegate("a","click",function(){
				formid = this.parentNode.children['3'].name;
				var form = document.getElementById(formid);
				if(form.style.display == 'block'){
					form.style.display = 'none';
				}else{
					form.style.display = 'block';
				}
			});
			//comments tree
			function commentstree(el){
				//container
				var comments = document.createElement('div');
				comments.className = 'comments';
				//pic
				var headpic = document.createElement('img');
				headpic.className = 'headpic';
				headpic.src = 'img/user02.png';
				//nicknamebox
				var nicknamebox = document.createElement('div');
				nicknamebox.className = 'nickname';
				//comment box
				var commentbox = document.createElement('div');
				//nickname
				var nickname = document.createElement('h4');
				nickname.innerHTML = el['nickname'];
				commentbox.appendChild(nickname);
				//created time
				var time = document.createElement('i');
				time.className = 'createdtime';
				time.innerHTML = el['created_at'];
				commentbox.appendChild(time);
				//comments
				var com = document.createElement('div');
				com.className = 'comm';
				com.innerHTML = el['comment'];
				commentbox.appendChild(com);
				//add reply
				var addcom = document.createElement('img');
				var reply = document.createElement('a');
				addcom.className = 'add-com';
				addcom.src = 'img/com.png';
				reply.innerText = '回复';
				reply.className = 'add-reply';
				reply.name = el['id'];
				commentbox.appendChild(reply);
				commentbox.appendChild(addcom);
				nicknamebox.appendChild(commentbox);
				//form
				var form = document.querySelector('.form-box').cloneNode(true);
				var parent_id = el['id'];
				form.children['0'].id = el['id'];
				form.children['0'].style.display = 'none';
				form.children['0'].children['1'] = parent_id;
				form.children['0'].children['1'].value = parent_id;
				nicknamebox.appendChild(form);
				//append
				comments.appendChild(headpic);
				comments.appendChild(nicknamebox);
				//child
				var child = [];
				if(el['children'].length != 0){
					for(var i = 0;i < el['children'].length;i ++){
						childcms = commentstree(el['children'][i]);
						comments.appendChild(childcms);
					}
				}else{
					return comments;	
				}
				return comments;	
			}
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