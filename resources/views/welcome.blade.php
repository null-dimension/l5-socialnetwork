@extends('layouts.master')

@section('title')
	Welcome
@endsection

@section('content')
	@include('includes.message-block')
	<div class="row">
		<div class="col-md-6">
			<h3>Sign Up</h3>
			<form action="{{ route('signup') }}" method="post">
				{{ csrf_field() }}
				<!--
				Or this method can also be used for token
				<input type="hidden" name="_token" value="{{ Session::token() }}">
				-->
				<div class="form-group {{ $errors->has('email')? 'has-error':'' }}">
					<label for="email">Email: </label>
					<input class="form-control" type="email" id="email" name="email" value="{{ Request::old('email') }}">
				</div>
				<div class="form-group {{ $errors->has('username')? 'has-error':'' }}">
					<label for="username">Username: </label>
					<input class="form-control" type="text" id="username" name="username" value="{{ Request::old('username') }}">
				</div>
				<div class="form-group {{ $errors->has('password')? 'has-error':'' }}">
					<label for="password">Password: </label>
					<input class="form-control" type="password" id="password" name="password" value="{{ Request::old('password') }}">
				</div>
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>

		<div class="col-md-6">
			<h3>Sign In</h3>
			<form action="{{ route('signin') }}" method="post">
				{{ csrf_field() }}
				<div class="form-group  {{ $errors->has('email')? 'has-error':'' }}">
					<label for="email">Email: </label>
					<input class="form-control" type="email" id="email" name="email" value="{{ Request::old('email') }}">
				</div>
				<div class="form-group  {{ $errors->has('password')? 'has-error':'' }}">
					<label for="password">Password: </label>
					<input class="form-control" type="password" id="password" name="password" value="{{ Request::old('password') }}">
				</div>
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
		</div>
	</div>

	

@endsection