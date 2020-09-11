@extends('layouts.app')

@section('title', 'New Employee')

@section('main')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <form action="{{ route('employees.store') }}" method="post" class="validate-form">
                    @csrf()
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="control-label">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                           name="name"
                                           data-rule-required="true"
                                           data-rule-maxlength="255">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email" class="control-label">Email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                           id="email"
                                           name="email" data-rule-required="true" data-rule-maxlength="255">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="gender" class="control-label">Gender</label>
                                    <select type="text" class="form-control @error('gender') is-invalid @enderror"
                                            id="gender"
                                            name="gender"
                                            data-rule-required="true">
                                        <option value="">Select Option</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role" class="control-label">Role</label>
                                    <select type="text" class="form-control @error('role') is-invalid @enderror"
                                            id="role"
                                            name="role" data-rule-required="true" data-rule-maxlength="255">
                                        <option value="">Select Option</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="employment_type" class="control-label">Employment Type</label>
                                    <select type="text" class="form-control @error('employment_type') is-invalid @enderror"
                                            id="employment_type"
                                            name="employment_type" data-rule-required="true" data-rule-maxlength="255">
                                        <option value="">Select Option</option>
                                        @foreach($employmentTypes as $employmentType)
                                            <option
                                                value="{{ $employmentType->id }}">{{ $employmentType->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('employment_type')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="department" class="control-label">Department</label>
                                    <select type="text" class="form-control @error('department') is-invalid @enderror"
                                            id="department"
                                            name="department" data-rule-required="true" data-rule-maxlength="255">
                                        <option value="">Select Option</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('department')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        @include('app.partials.forms.actions', ['url' => route('employees.index')])
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
