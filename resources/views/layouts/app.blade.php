<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MUUCH') }}</title>

    <link href="/css/app.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700">
      <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons">

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Navegación</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a href="{{ url('/') }}" class="navbar-brand">
                        <span class="pull-right text-primary" style="padding:.32em;"><strong>MUUCH</strong></span>
                    <img src="/img/logo_h.png" alt="Iluméxico" style="height:35px;padding:3px;">
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/ingresar') }}">Ingresa</a></li>
                            <li><a href="{{ url('/registrar') }}">Regístrate</a></li>
                        @else
                            @ability('admin', '')
                            <li class="text-primary"><a href="/config"><i class="material-icons">settings</i> </a></li>
                            @endability
                            <li class="text-danger">
                                <a href="{{ url('/logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Salir <i class="material-icons">exit_to_app</i>
                                </a>
                                <form id="logout-form" action="/salir" method="POST">{{ csrf_field() }}</form>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">

            @yield('content')

            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2><i class="material-icons">accessibility</i></h2>
                    <h4>La palabra MUUCH proviene del maya y significa "juntos".</h4>
                    <p class="small">
                    Esta plataforma fue creada con la intención de acercarnos y ayudarnos a construir un mejor ILUMÉXICO JUNTOS.<br> Te invitamos a explorar la plataforma, así como a enviarnos todos tus comentarios para enriquecerla.</p>
                </div>
                <div class="col-md-12">
                    <hr>
                    <strong class="small">Accesos rápidos:</strong> <a href="http://mail.ilumexico.mx" target="_blank" class="btn btn-default btn-sm" style="margin:0"><i class="material-icons" style="font-size:16px">mail_outline</i> Correo</a> <a href="http://sf.ilumexico.mx" target="_blank" class="btn btn-defult btn-sm" style="margin:0"><i class="material-icons" style="font-size:16px">backup</i> Salesforce</a> <a href="http://tinyurl.com/TWAPK440" target="_blank" class="btn btn-default btn-sm" style="margin:0"><i class="material-icons" style="font-size:16px">phone_android</i> Descarga TARO</a> <!-- <a href="http://vbx.ilumexico.mx" target="_blank" class="btn btn-default btn-sm btn-primary" style="margin:0" title="vbx@ilumexico.mx - prometeo1" data-toggle="tooltip" data-placement="bottom"><i class="material-icons">sms</i> SMS</a> -->
                    <hr>
                    <p class="text-center">&copy; 2017 Iluméxico</p>
                </div>
            </div>
            <div style="width:100%; ">

            </div>

    </div>
</div>

    @yield('modals')

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script type="text/javascript">
            $.material.init();
    </script>

    @yield('scripts')
</body>
</html>
