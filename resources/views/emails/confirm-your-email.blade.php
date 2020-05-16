@component('mail::message')
# Plus q`un pas avant de rejoindre Enenga Mènè !

Nous avons besoin que vous confirmiez votre email

@component('mail::button', ['url' => route('confirm-email') . '?token=' . $user->confirm_token])
Confirmez votre e-mail
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
