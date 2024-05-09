@extends('admin.layout.auth')

@section('content')
<div class="login-tabib">
    <div>
        <div class="text-center">
            <a class="logo" href="index.html">
                <img class="img-fluid" src="{{asset('assets/images/Health-removebg-preview.png')}}" alt="login page">
            </a>
        </div>
        <div class="login-main">
            <form class="theme-form" role="form" method="POST" action="{{ url('/admin/login') }}">
                @csrf
                <h4>Sign in to account</h4>
                <p>Enter your email & password to login </p>
                <div class="form-group m-b-10">
                    <label class="col-form-label">Email Address</label>
                    <input class="form-control" type="email" name="email" placeholder="Enter your email address">
                </div>
                <div class="form-group m-b-10">
                    <label class="col-form-label">Password</label>
                    <div class="form-input position-relative">
                        <input class="form-control" type="password" name="password" placeholder="Enter your password">
                        <div class="show-hide"><span class="show"></span></div>
                    </div>
                </div>
                <div class="form-group mb-0">
                    <div class="checkbox p-0">
                        <input id="checkbox1" type="checkbox">
                        <label class="text-muted" name="remember" for="checkbox1">Remember password</label>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <a class="link text-primary" href="{{ url('/admin/password/reset') }}">Forgot password?</a>
                    <div class="mt-3">
                        <button class="btn btn-primary" type="submit"> Sign In </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection





{{-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/admin/password/reset') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}