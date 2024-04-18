@extends('staff.layout.auth')

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
            <form class="theme-form" role="form" method="POST" action="{{ url('/staff/password/reset') }}">
                <div class="text-center mb-4">
                    <h4>Reset Password</h4>
                </div>
                <hr>
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group m-b-10">
                    <div class="form-input position-relative {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control" type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" autofocus>
                        <div class="show-hide"><span class="show"></span></div>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <br>

                    <div class="form-input position-relative {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label class="form-label" for="password-input">Password</label>
                        <input class="form-control" type="password" name="password" for="password-input" required placeholder="Enter your password">
                        <div class="show-hide"><span class="show"></span></div>
                        @if ($errors->has('password'))
                            <br>
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </div>
                        @endif
                    </div>

                    <br>

                    <div class="form-input position-relative {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label class="form-label" for="password-input">Confirm Password</label>
                        <input class="form-control" type="password" name="password_confirmation" for="password-input" required placeholder="Confirm your password">
                        <div class="show-hide"><span class="show"></span></div>
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <br>
                <div class="form-group mb-0">
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary w-100">Reset password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End forgot password -->

@endsection
