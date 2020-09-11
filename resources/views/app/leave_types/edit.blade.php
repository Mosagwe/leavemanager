@extends('layouts.app')

@section('title', 'Edit Leave Type')

@section('main')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <form action="{{ route('leave-types.update', ['leave_type' => $leaveType]) }}" method="post"
                      class="validate-form">
                    @csrf()
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="name" class="control-label">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name"
                                           name="name"
                                           data-rule-required="true"
                                           data-rule-maxlength="255"
                                           value="{{ $leaveType->name }}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="maximum_days" class="control-label">Maximum Days</label>
                                    <input type="text" class="form-control @error('maximum_days') is-invalid @enderror"
                                           id="maximum_days" name="maximum_days"
                                           data-rule-required="true"
                                           data-rule-digits="true"
                                           value="{{ $leaveType->maximum_days }}">
                                    @error('maximum_days')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="carry_over_days" class="control-label">Carry Over Days</label>
                                    <input type="text"
                                           class="form-control @error('carry_over_days') is-invalid @enderror"
                                           id="carry_over_days" name="carry_over_days"
                                           data-rule-required="true"
                                           data-rule-digits="true"
                                           value="{{ $leaveType->carry_over_days }}">
                                    @error('carry_over_days')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="gender" class="control-label">Gender</label>
                                    <select class="form-control @error('gender') is-invalid @enderror" id="gender"
                                            name="gender"
                                            data-rule-required="true">
                                        <option value="">Select Option</option>
                                        <option value="All" {{ $leaveType->gender == 'All' ? 'selected':'' }}>All
                                        </option>
                                        <option value="Male" {{ $leaveType->gender == 'Male' ? 'selected':'' }}>Male
                                        </option>
                                        <option value="Female" {{ $leaveType->gender == 'Female' ? 'selected':'' }}>
                                            Female
                                        </option>
                                    </select>
                                    @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div
                                                class="custom-control custom-checkbox @error('can_use_partially') is-invalid @enderror">
                                                <input type="checkbox" class="custom-control-input" name="can_use_partially"
                                                       {{ $leaveType->can_use_partially ? 'checked':'' }}
                                                       id="can_use_partially">
                                                <label for="can_use_partially" class="custom-control-label">Can Use
                                                    Partially</label>
                                            </div>
                                            @error('can_use_partially')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div
                                                class="custom-control custom-checkbox @error('calendar_days') is-invalid @enderror">
                                                <input type="checkbox" class="custom-control-input" name="calendar_days"
                                                       {{ $leaveType->calendar_days ? 'checked':'' }}
                                                       id="calendar_days">
                                                <label for="calendar_days" class="custom-control-label">Calendar Days</label>
                                            </div>
                                            @error('calendar_days')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="px-3">
                                    <h6>Employment Types</h6>
                                    <hr>
                                    @foreach($employmentTypes as $employmentType)
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input type="checkbox" class="custom-control-input"
                                                   name="employment_types[]"
                                                   id="employment_types{{ $employmentType->id }}"
                                                   {{ $leaveType->employmentTypes->contains('id',$employmentType->id) ? 'checked':'' }}
                                                   value="{{ $employmentType->id }}">
                                            <label for="employment_types{{ $employmentType->id }}"
                                                   class="custom-control-label">
                                                {{ $employmentType->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        @include('app.partials.forms.actions', ['url' => route('leave-types.index')])
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
