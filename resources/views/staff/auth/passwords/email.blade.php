@extends('staff.layout.auth')

<!-- Main Content -->
@section('content')
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
            <form class="theme-form" role="form" method="POST" action="{{ url('/staff/password/email') }}">
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
                    <a class="ms-2 text-primary text-center" href="{{ url('/staff/login') }}">Sign in</a>
                </p>
            </form>
        </div>
    </div>
</div>
<!-- End forgot password -->
@endsection
