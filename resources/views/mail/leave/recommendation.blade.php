@component('mail::message')
# Hello {{ $user->name }}

{{ $leaveRequest->applicant->name }} has applied to be on leave from
{{ $leaveRequest->start_at }} to
{{ $leaveRequest->end_at }}. Please take a moment to review and process the application.

@component('mail::button', ['url' => route('login')])
Log In
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
