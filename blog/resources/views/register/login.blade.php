@extends('layouts.topheader')
@section('form')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Login</div>
				<div class="panel-body">
				@if(isset($err))
					<span style="color: red;width: 30%;display: block;margin:5px auto;">
						<strong>{{ $err }}</strong>
					</span>
				@endif
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/sinin') }}">
						{!! csrf_field() !!}
						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
								@if ($errors->has('email'))
								<span class="help-block">
									<strong>{{ $errors->first('email') }}</strong>
								</span>
								@endif
							</div>
						</div>
						<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
								@if ($errors->has('password'))
								<span class="help-block">
									<strong>{{ $errors->first('password') }}</strong>
								</span>
								@endif
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
								<i class="fa fa-btn fa-sign-in"></i>Login
								</button>
								<a class="btn btn-link" href="{{ url('password/reset') }}">Forgot Your Password?</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection