@extends('layouts.app')

@section('title', 'Holidays')

@section('action')
    <a href="{{ route('holidays.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus-circle fa-sm text-white-50"></i> Create New
    </a>
@stop

@section('main')
    <div class="card">
        <div class="card-body">
            {!! $dataTable->table() !!}
        </div>
    </div>
@endsection

@include('app.partials.datatables.scripts')
