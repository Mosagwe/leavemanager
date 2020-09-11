@extends('layouts.auth')

@section('auth')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="username" class="col-form-label">{{ __('Email Address / Username') }}</label>
            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                   name="username" value="{{ old('username') }}" required autofocus>
            @error('username')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password" class="col-form-label">{{ __('Password') }}</label>
            <input id="palossword" type="password" class="form-control" name="password" required>
            @error('password')
            <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="form-control custom-control-input" name="remember" id="remember">
                <label for="remember" class="custom-control-label">Remember Me</label>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block my-2">
                <i class="fa fa-sign-in"></i>
                {{ __('Login') }}
            </button>
            @if (Route::has('password.request'))
                <a class="btn btn-link my-2 p-0" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </div>
    </form>
@endsection
