@extends('layouts.app')

@section('title', 'New Employment Type')

@section('main')
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <form action="{{ route('employment-types.store') }}" method="post" class="validate-form">
                    @csrf()
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name" class="control-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                   data-rule-required="true"
                                   data-rule-maxlength="255">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description" class="control-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                      data-rule-maxlength="255"></textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        @include('app.partials.forms.actions', ['url' => route('employment-types.index')])
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
