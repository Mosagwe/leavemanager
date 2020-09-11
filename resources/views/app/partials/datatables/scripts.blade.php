@push('scripts')
    @isset($buttons)
        <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    @endisset
    {!! $dataTable->scripts() !!}
@endPush
