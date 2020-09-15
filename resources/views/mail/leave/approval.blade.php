@component('mail::message')
# Hello {{ $user->name }}

{{ $leaveRequest->applicant->name }} has been recommended to be on leave from
{{ $leaveRequest->start_at->format(config('custom.date_format')) }} to
{{ $leaveRequest->end_at->format(config('custom.date_format')) }}.

Please take a moment to review and process the application.

@component('mail::button', ['url' => route('login')])
Log In
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
