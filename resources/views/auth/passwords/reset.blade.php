@extends('layouts.auth')

@section('auth')
    <h3 class="text-center">Reset Password</h3>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group">
            <label for="email" class="col-form-label t">{{ __('E-Mail Address') }}</label>
            <input id="email" type="email" class="form-control" name="email"
                   value="{{ $email ?? old('email') }}"
                   required autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password" class="col-form-label">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                   name="password" required autocomplete="new-password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password-confirm" class="col-form-label">{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password" class="form-control"
                   name="password_confirmation"
                   required
                   autocomplete="new-password">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">
                {{ __('Reset Password') }}
            </button>
        </div>
    </form>
@endsection
