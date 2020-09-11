@extends('layouts.auth')

@section('auth')
    <h3 class="text-center">Password Reset</h3>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group">
            <label for="email" class="col-form-label">{{ __('E-Mail Address') }}</label>
            <input id="email" type="email" class="form-control" name="email"
                   value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">
                {{ __('Send Password Reset Link') }}
            </button>
        </div>
    </form>
@endsection
