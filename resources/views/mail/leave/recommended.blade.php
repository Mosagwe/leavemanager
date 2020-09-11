@component('mail::message')
# Hello, {{ $user->name }}

The leave request you made for the period {{ $leaveRequest->start_at }}
to {{ $leaveRequest->end_at }},
has been recommended for approval.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
