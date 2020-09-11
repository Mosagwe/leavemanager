@extends('layouts.app')

@section('title', 'My Applications')

@section('action')
    <a href="{{ route('applications.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
        <i class="fas fa-plus-circle fa-sm text-white-50"></i> Create New
    </a>
@stop

@section('main')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    {!! $dataTable->table() !!}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Leave Balances</h5>
                    <table class="table">
                        <tr>
                            <th>Type</th>
                            <th>Eligible</th>
                            <th>Balance</th>
                        </tr>
                        @foreach(Auth::user()->leaveBalances as $leaveBalance)
                            <tr>
                                <td>{{ $leaveBalance->leaveType->name }}</td>
                                <td>{{ $leaveBalance->leaveType->maximum_days }}</td>
                                <td>{{ $leaveBalance->balance }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('app.partials.datatables.scripts')
