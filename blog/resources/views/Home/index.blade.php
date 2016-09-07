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
					{{ $content }}
				</div>
				<div class="col-md-4 right-content"></div>
			</div>
		</div>
	</div>
	@endsection