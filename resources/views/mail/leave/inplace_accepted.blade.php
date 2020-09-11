@component('mail::message')
# Hello {{ $user->name }}

{{ $leaveRequest->employeInplace->name }} has accepted to be in place while you are on leave for the period starting from
{{ $leaveRequest->start_at }} to {{ $leaveRequest->end_at }}.

The leave request is now pending recommendation by your supervisor.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
