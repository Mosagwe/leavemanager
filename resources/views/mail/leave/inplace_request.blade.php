@component('mail::message')
# Hello, {{ $user->notification }}

{{ $leaveRequest->applicant->name }} has requested for you to be in place while on leave from
{{ $leaveRequest->start_at }} to {{ $leaveRequest->end_at }}

Please log in to accept or decline the request.

@component('mail::button', ['url' => route('login')])
Log In
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
