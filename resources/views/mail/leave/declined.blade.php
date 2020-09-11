@component('mail::message')
# Hello, {{ $user->name }}

The leave request you had made for the period {{ $leaveRequest->start_at }}
to {{ $leaveRequest->end_at }} has been declined.

@if($reason)
@component('mail::panel')
    {{ $reason }}
@endcomponent
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent
