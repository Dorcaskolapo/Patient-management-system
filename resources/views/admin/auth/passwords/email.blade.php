@extends('admin.layout.auth')

@section('content')
<!-- Forgot password -->
<div class="login-tabib">
    <div>
        <div class="text-center">
            <a class="logo" href="index.html">
                <img class="img-fluid" src="{{ asset('assets/images/logo.png') }}" alt="login page">
            </a>

        </div>
        <div class="login-main">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form class="theme-form" role="form" method="POST" action="{{ url('/admin/password/email') }}">
                <h4>Recover my password </h4>
                @csrf
                <div class="form-group m-b-10">
                    <p>Please enter your email address below to receive instructions for resetting password.</p>
                    <div class="form-input position-relative {{ $errors->has('email') ? ' has-error' : '' }}">
                        <input class="form-control" type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}">
                        <div class="show-hide"><span class="show"></span></div>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group mb-0">
                    <div class="mt-3">
                        {{-- <a href="#" class="btn btn-primary w-100">Reset password</a> --}}
                        <button type="submit" class="btn btn-primary w-100">Reset password</button>
                    </div>
                </div>
                <p class="mt-4 mb-0">
                    Know your password?
                    <a class="ms-2 text-primary text-center" href="{{ url('/admin/login') }}">Sign in</a>
                </p>
            </form>
        </div>
    </div>
</div>
<!-- End forgot password -->






{{-- <!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/password/email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
