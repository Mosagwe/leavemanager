@extends('layouts.app')

@section('title', 'Approved Leave Requests')

@section('main')
    <div class="card">
        <div class="card-body">
            {!! $dataTable->table() !!}
        </div>
    </div>
@endsection

@include('app.partials.datatables.scripts', ['buttons' => true])
