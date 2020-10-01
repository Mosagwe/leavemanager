@extends('layouts.app')

@section('title', 'Pending Approval Leave Requests')

@section('main')
    <div class="card">
        <div class="card-body">
            {!! $dataTable->table() !!}
        </div>
    </div>
    @include('app.leave.modals.decline');
@endsection

@include('app.partials.datatables.scripts')
