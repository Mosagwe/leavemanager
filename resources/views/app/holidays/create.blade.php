@extends('layouts.app')

@section('title', 'New Holiday')

@section('main')
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <form action="{{ route('holidays.store') }}" method="post" class="validate-form">
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
                        <div class="form-group">
                            <label for="date" class="control-label">Date</label>
                            <div class="input-group date @error('date') is-invalid @enderror" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                                <input type="text" readonly class="form-control"
                                       name="date" id="date">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                            @error('date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="is_annual" id="is_annual">
                                <label for="is_annual" class="custom-control-label">Annual</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        @include('app.partials.forms.actions', ['url' => route('holidays.index')])
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
