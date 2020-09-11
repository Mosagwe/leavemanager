@component('mail::message')
# Hello {{ $user->name }}

Your leave application leave from {{ $leaveRequest->start_at }}
to {{ $leaveRequest->end_at }} has been approved.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
