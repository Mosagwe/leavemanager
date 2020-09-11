@component('mail::message')
# Hello {{ $user->name }}

{{ $leaveRequest->employeeInplace->name }} has declined to be in place for the leave request you made starting from
{{ $leaveRequest->start_at }} to {{ $leaveRequest->end_at }}.

You may still edit the application and make any edits that you may deem suitable.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
