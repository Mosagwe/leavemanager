@extends('layouts.app')

@section('title', 'Pending Approval Leave Requests')

@section('main')
    <div class="card">
        <div class="card-body">
            {!! $dataTable->table() !!}
        </div>
    </div>
@endsection

@include('app.partials.datatables.scripts')