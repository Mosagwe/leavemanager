@component('mail::message')
# Hello, {{ $user->name }}

Please note that {{ $leaveRequest->applicant->name }} has applied to be on leave from
{{ $leaveRequest->start_at->format(config('custom.date_format')) }} to {{ $leaveRequest->end_at->format(config('custom.date_format')) }}.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
