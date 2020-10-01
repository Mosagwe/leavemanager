@component('mail::message')
# Hello {{ $user->name }}

{{ $leaveRequest->employeeInplace->name }} has accepted to be in place while you are on leave for the period starting from
{{ $leaveRequest->start_at->format(config('custom.date_format')) }} to {{ $leaveRequest->end_at->format(config('custom.date_format')) }}.

The leave request is now pending recommendation by your supervisor.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
