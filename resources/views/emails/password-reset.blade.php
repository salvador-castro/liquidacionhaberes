@component('mail::message')

# Hola {{ $user->name }}

Recibimos una solicitud para restablecer tu contraseña.

@component('mail::button', ['url' => $url])
Restablecer Contraseña
@endcomponent

Si no solicitaste este cambio, no es necesario hacer nada más.

Gracias,<br>
{{ config('app.name') }}

@endcomponent
