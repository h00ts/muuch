@component('mail::message')

Hola {{ $userName }},

Estás a un paso de ingresar a tu nueva cuenta de MUUCH - por favor haz clic en el siguiente botón para ingresar y reactivar tu cuenta:

@component('mail::button', ['url' => $url, 'color' => 'orange'])
    REACTIVA TU CUENTA
@endcomponent

@component('mail::panel')
    Tu contraseña temporal es: prometeo
@endcomponent

Podras ingresar usando tu correo {{ $userEmail }} desde tu computadora o telefono móvil, entrando a la página <a href="http://muuch.ilumexico.mx">muuch.ilumexico.mx</a>.

@endcomponent