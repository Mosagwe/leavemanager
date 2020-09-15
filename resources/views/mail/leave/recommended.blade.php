@component('mail::message')
# Hello, {{ $user->name }}

The leave request you made for the period {{ $leaveRequest->start_at->format(config('custom.date_format')) }}
to {{ $leaveRequest->end_at->format(config('custom.date_format')) }},
has been recommended for approval.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
