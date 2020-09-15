@component('mail::message')
# Hello {{ $user->name }}

Your leave application leave from {{ $leaveRequest->start_at->format(config('custom.date_format')) }}
to {{ $leaveRequest->end_at->format(config('custom.date_format')) }} has been approved.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
