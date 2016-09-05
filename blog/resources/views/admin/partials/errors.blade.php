@if (count($errors) > 0)
<div class="form-group">
	<div class="alert alert-danger col-md-12" >
		<div>
			<strong>Whoops!</strong>
			There were some problems with your input.<br><br>
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>
@endif