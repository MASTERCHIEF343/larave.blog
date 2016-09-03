@if (count($errors) > 0)
<div class="form-group">
	<label class="col-md-4"></label>
	<div class="alert alert-danger col-md-6" >
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