@extends('layouts.master')

@section('body-class','auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-5 my-5">
                <div class="card my-5">
                    <div class="card-body">
                        <div >
                            <img src="{{ asset('img/hudumalogo2.png')}}" style="display: block;  margin-left: auto;  margin-right: auto;
  ">
                        </div>
                        <hr>
                        
                        <h4 class="text-center" style="font-weight: bold;"><font style="color:#000;">Huduma </font><font style="color:#fa3333;">Kenya </font><font style="color:#009933;">Secretariat </font></h4>
                        <div class="auth-form my-4">
                            @yield('auth')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
