@component('mail::message')

Hola {{ $userName }},

Solo un paso mas para que pueda ingresar a tu nueva cuenta de MUUCH - haz clic en el siguiente botón para activar tu cuenta:

@component('mail::button', ['url' => $url, 'color' => 'orange'])
ACTIVA TU CUENTA
@endcomponent

Podras ingresar usando tu correo electrónico {{ $userEmail }} desde tu computadora o telefono móvil entrando a <a href="http://muuch.ilumexico.mx">muuch.ilumexico.mx</a>.

@endcomponent