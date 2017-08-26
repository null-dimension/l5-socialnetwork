@if(count($errors) > 0)
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<ul class="alert alert-danger">
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	</div>
@endif

@if(Session::has('message'))
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="alert alert-success">
				{{ Session::get('message') }}
			</div>
		</div>
	</div>
@endif