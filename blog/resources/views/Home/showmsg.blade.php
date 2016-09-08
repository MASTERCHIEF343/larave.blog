@extends('layouts.homeheader')
	<!--link-->
	@section('link')
	<link rel="stylesheet" type="text/css" href="../resources/assets/css/main-msg.css">
	@endsection
	<!--content-->
	@section('content')
		<div class="main-msg">
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
							</article>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	@endsection