@component('mail::message')
# Activation Email

Thanks for Registration. Please Active Your Account!

@component('mail::button', ['url' => Route('Auth.activation',[
    'token' => $user->activation_token,
    'email' => $user->email,
]
)])
Active
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
