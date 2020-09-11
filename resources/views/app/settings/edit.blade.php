@extends('layouts.app')

@section('title', 'Settings')

@section('main')
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('settings.update') }}" method="post">
                <div class="card">
                    <div class="card-body">
                        @csrf()
                        @method('PUT')
                        <div class="form-group">
                            <label class="control-label" for="current_password">Current Password</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                   name="current_password" data-rule-required="true"
                                   id="current_password">
                            @error('current_password')
                            <span class="invalid-feedback">
                           <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="password">New Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                   data-rule-minlength="6"
                                   data-rule-required="true" id="password">
                            @error('password')
                            <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                   name="password_confirmation"
                                   data-rule-equalTo="#password" id="password_confirmation">
                            @error('password_confirmation')
                            <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" name="action" value="save" class="btn btn-primary">
                            <i class="fa fa-save"></i> Save
                        </button>
                        <a href="{{ route('applications.index') }}" class="btn btn-secondary">
                            &times; Close
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
