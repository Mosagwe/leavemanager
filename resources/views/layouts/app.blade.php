@extends('layouts.master')

@section('content')
    <div id="wrapper">
        @include('app.nav.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('app.nav.topbar')
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h4 class="mb-0 ml-2 text-gray-800">@yield('title')</h4>
                        @yield('action')
                    </div>
                    @yield('main')
                </div>
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; {{ config('app.name') }} {{ date('Y') }}</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection
