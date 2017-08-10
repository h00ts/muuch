@component('mail::message')

    Hola {{ $userName }},

    Estás a un paso de ingresar a tu nueva cuenta de MUUCH - por favor haz clic en el siguiente botón para activar tu cuenta

    @component('mail::button', ['url' => $url, 'color' => 'orange'])
        ACTIVA TU CUENTA
    @endcomponent

    Podras ingresar usando tu correo {{ $userEmail }} desde tu computadora o telefono móvil, entrando a la página <a href="http://muuch.ilumexico.mx">muuch.ilumexico.mx</a>.

    @component('mail::panel')
        Tu contraseña temporal es: prometeo
    @endcomponent

@endcomponent