@component('mail::message')
# Hello, {{ $user->name }}

Your new account has been created on the {{ config('app.name') }} application.

Please user the details to log in. You will be required to change your password on first log in.

@component('mail::panel')
email: {{ $user->email }}

password: {{ $password }}
@endcomponent

@component('mail::button', ['url' => route('login')])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
