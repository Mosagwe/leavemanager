@component('mail::message')

# Hello {{ $leaveRequest->employeeInplace->name }},

This is just a polite reminder that {{ $leaveRequest->applicant->name }} had requested for you to be in place while on leave from
{{ $leaveRequest->start_at->format(config('custom.date_format')) }} to {{ $leaveRequest->end_at->format(config('custom.date_format')) }},
which was sent on {{ $leaveRequest->created_at->format(config('custom.date_format')) }}.

Kindly take a moment and log in to accept or decline the request.

Thanks in advance for your cooperation.
@component('mail::button', ['url' => route('login')])
    Log In
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
