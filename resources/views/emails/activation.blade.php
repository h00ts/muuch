@component('mail::message')

Hola {{ $userName }},

@component('mail::panel')
ya puedes ingresar a tu nueva cuenta de Muuch. Puedes accesar a ella usando tu correo electrónico ({{ $userEmail }}) en <a href="http://muuch.ilumexico.mx">muuch.ilumexico.mx</a> desde tu computadora o telefono móvil.
@endcomponent

@component('mail::button', ['url' => $url, 'color' => 'orange'])
Activa tu cuenta
@endcomponent

Cualquier duda, queja o sugerencia que tengas puedes comunicarla con tu coordinador regional o enviando un correo a ruslan@ilumexico.mx

Garcias.
@endcomponent