@extends('layouts.app')

@section('title', 'My Applications')

@section('action')
    <a href="{{ route('applications.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
        <i class="fas fa-plus-circle fa-sm text-white-50"></i> Create New
    </a>
@stop

@section('main')
    <div class="row">
        <div class="col-md-10 offset-1">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4>Leave Balances</h4>
                    </div>
                    <table class="table ">
                        <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Type of Leave</th>
                            <th>Days Taken</th>
                            <th>Balance</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($leaveRequests as $leaveRequest)
                        <tr>
                            <td>{{ $leaveRequest->empname }}</td>
                            <td>{{ $leaveRequest->leaveType }}</td>
                            <td>{{ $leaveRequest->total }}</td>
                            <td>{{ $leaveRequest->balance }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection


