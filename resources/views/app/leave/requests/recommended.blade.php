@extends('layouts.app')

@section('title', 'Pending Approval Leave Requests')

@section('action')
    <button id="approveAll" class="btn btn-success" {{ \App\Models\LeaveRequest::pendingapproval()->count() > 0 ?'':'disabled' }}>
        <i class="fa fa-check-circle"></i>
        Approve All
    </button>
@endsection

@section('main')
    <div class="card">
        <div class="card-body">
            {!! $dataTable->table() !!}
        </div>
    </div>
    @include('app.leave.modals.decline');
@endsection

@include('app.partials.datatables.scripts')

@push('scripts')
    <script>
        $(document).ready(function () {
            $(".card").on('click', '.checkAll', function () {
                if ($(this).is(':checked')) {
                    $('#approvedLeaveRequestsTable input:checkbox').prop('checked', true);
                } else {
                    $('#approvedLeaveRequestsTable input:checkbox').prop('checked',false);
                }
            });

            $("#approveAll").click(function () {
                var ids = [];
                $('#approvedLeaveRequestsTable input.check:checkbox:checked').each(function () {
                    ids.push($(this).val())
                });

                // No checkbox selected
                if (ids.length == 0) {
                    Swal.fire({
                        title: "Error",
                        text: "Please select at least one leave request",
                        icon: "error"
                    });
                    return false;
                }

                $('#approveAll i').removeClass('fa fa-check-circle').addClass('fa fa-spin fa-spinner');

                $.ajax({
                    url: "{{ route('approve.all') }}",
                    method: "POST",
                    data: {ids: ids, _token: "{{ csrf_token() }}"},
                    success: function (data) {
                        $('#approveAll i').removeClass('fa fa-spin fa-spinner').addClass('fa fa-check-circle');
                        if (data.success) {
                            Swal.fire({
                                title: "Success",
                                text: data.number + " leave requests approved successfully",
                                icon: "success"
                            }).then(function () {
                                window.location.reload()
                            });
                        } else {
                            Swal.fire({
                                title: "Error",
                                text: data,
                                icon: "error"
                            }).then(function () {
                                $('#approvedLeaveRequestsTable').DataTable().ajax.reload()
                            })
                        }
                    },
                    error: function (error) {
                        $('#approveAll i').removeClass('fa fa-spin fa-spinner').addClass('fa fa-check-circle');
                        Swal.fire({
                            title: "Error",
                            text: error.message,
                            icon: "error"
                        }).then(function () {
                            $('#approvedLeaveRequestsTable').DataTable().ajax.reload()
                        })
                    }
                });
            });
        });
    </script>
@endpush
