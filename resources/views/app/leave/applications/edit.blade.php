@extends('layouts.app')

@section('title', 'Edit Application')

@section('main')
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <form id="leaveApplicationForm"
                      action="{{ route('applications.update', ['application' => $leaveRequest ]) }}" method="post"
                      class="validate-form">
                    @csrf()
                    @method('PUT')
                    <input type="hidden" id="leave_request_id" value="{{ $leaveRequest->id }}">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="leave_type" class="control-label">Leave Type</label>
                            <select type="text" class="form-control @error('leave_type') is-invalid @enderror"
                                    id="leave_type"
                                    name="leave_type"
                                    data-rule-required="true">
                                <option value="">Select Option</option>
                                @foreach(Auth::user()->leaveBalances as $balance)
                                    @if ($balance->leaveType)
                                        <option data-balance="{{ $balance->balance }}" data-partial="{{  $balance->leaveType->can_use_partially}}"
                                                data-max-days="{{  $balance->leaveType->maximum_days}}"
                                                {{ $leaveRequest->leave_type_id == $balance->leave_type_id ? "selected":"" }}
                                                value="{{ $balance->leave_type_id }}">
                                            {{ $balance->leaveType->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('leave_type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="start_at" class="control-label">Start Date</label>
                            <div class="input-group date @error('start_at') is-invalid @enderror">
                                <input type="text" readonly class="form-control"
                                       value="{{ $leaveRequest->start_at->format('Y-m-d') }}"
                                       name="start_at" id="start_at">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                            @error('start_at')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="days" class="control-label">Number of Days</label>
                            <input type="text" class="form-control @error('days') is-invalid @enderror" id="days"
                                   name="days"
                                   value="{{ $leaveRequest->number_of_days }}"
                                   data-rule-required="true"
                                   data-rule-digits="true">
                            @error('days')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="employee_inplace" class="control-label">Employee Inplace</label>
                            <select type="text" class="form-control @error('employee_inplace') is-invalid @enderror"
                                    id="employee_inplace"
                                    name="employee_inplace"
                                    data-rule-required="true">
                                <option value="">Select Option</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}"
                                        {{ $leaveRequest->employee_inplace == $employee->id ? "selected":"" }}>
                                        {{ $employee->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('employee_inplace')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="reason" class="control-label">Comments (optional)</label>
                            <textarea class="form-control @error('reason') is-invalid @enderror" id="reason"
                                      name="reason"
                                      data-rule-maxlength="255">{{ $leaveRequest->reason }}</textarea>
                            @error('reason')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        @include('app.partials.forms.actions', ['url' => route('applications.index')])
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4 offset-md-2">
            <div class="card mb-3" id="calendar" style="display: none"></div>
            <div id="leaveSummary" style="display: none"></div>
        </div>
    </div>
@endsection
