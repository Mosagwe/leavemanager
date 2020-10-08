@component('mail::message')
# Hello {{ $user->name }}

The leave application for
{{ $leaveRequest->applicant->name }} has been approved to be on leave from
{{ $leaveRequest->start_at->format(config('custom.date_format')) }} to
{{ $leaveRequest->end_at->format(config('custom.date_format')) }}.

@component('mail::button', ['url' => route('login')])
Log In
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
