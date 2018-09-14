@extends('layouts.login_layout')

@section('content')
<div id="login">
    <div class="container fadeInDown">
        <div class="row" style="margin-top: 50px;">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card">
                    @if (count($errors) > 0)
                        <div class="card-body">
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group fadeIn first" style="text-align: center;">
                            <div class="col-md-12">
                                <img src="{{ asset('images/user.svg') }}" width="70%">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="first_name" value="{{ old('name') }}" placeholder="Firstname">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="middle_name" value="{{ old('name') }}" placeholder="Middlename">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="last_name" value="{{ old('name') }}" placeholder="Lastname">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="username" value="{{ old('name') }}" placeholder="Username">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="password" class="form-control" name="password"  placeholder="Password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="password" class="form-control" name="password_confirmation"  placeholder="Confirm Password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
