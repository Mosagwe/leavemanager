@extends('layouts.app')

@section('title', 'My Applications')

@section('action')

@stop

@section('main')
    <div class="row">
        <div class="col-md-10 offset-1">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <h4 class="card-title">Leave Balances</h4>
                    </div>


                    <table id="leaveBalances" class="table table-bordered table-striped">
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

@push('scripts')
    <script>
        $(function () {
            $("#leaveBalances").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush


