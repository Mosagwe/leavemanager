@extends('layouts.app')

@section('title', 'Edit Role')

@section('main')
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <form action="{{ route('roles.update', ['role' => $role]) }}" method="post" class="validate-form">
                    @csrf()
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name" class="control-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                   name="name"
                                   data-rule-required="true"
                                   data-rule-maxlength="255"
                                   value="{{ $role->name }}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            @foreach($permissions as $permission)
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input" name="permissions[]"
                                           id="permissions{{ $permission->id }}"
                                           {{ $role->permissions->contains('id', $permission->id) ? "checked":"" }}
                                           value="{{ $permission->id }}">
                                    <label for="permissions{{ $permission->id }}" class="custom-control-label">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer">
                        @include('app.partials.forms.actions', ['url' => route('roles.index')])
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
