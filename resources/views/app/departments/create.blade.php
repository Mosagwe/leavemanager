@extends('layouts.app')

@section('title', 'New Department')

@section('main')
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <form action="{{ route('departments.store') }}" method="post" class="validate-form">
                    @csrf()
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name" class="control-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                   name="name"
                                   data-rule-required="true"
                                   data-rule-maxlength="255">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        @include('app.partials.forms.actions', ['url' => route('departments.index')])
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
