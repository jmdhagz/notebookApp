@extends('layouts.login_layout')

@section('content')
<div id="login">
	<div class="container fadeInDown">
		<div class="row" style="margin-top: 50px;">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="card">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group fadeIn first" style="text-align: center;">
							<div class="col-md-12">
								<img src="{{ asset('images/user.svg') }}" width="70%">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<input type="email" class="form-control fadeIn second" name="email" placeholder="email">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-12">
								<input type="password" class="form-control fadeIn third" name="password" placeholder="password">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-12">
								<button style="width: 100%;" type="submit" class="btn btn-primary fadeIn fourth">Login</button>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<a href="{{ route('register') }}" style="color: #6B5095;"><button style="width: 100%;" type="button" class="btn btn-default fadeIn fourth">Register</button></a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
