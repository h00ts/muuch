<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MUUCH') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
      <!-- Material Design fonts -->
      <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700">
      <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Navegación</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a href="{{ url('/muuch') }}" class="navbar-brand">
                    <img src="/img/logo.png" alt="Iluméxico" class="img--logo">
                        <h3 class="visuallyhidden">{{ config('app.name', 'MUUCH') }}</h3>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/ingresar') }}">Ingresa</a></li>
                            <li><a href="{{ url('/registrar') }}">Registrate</a></li>
                        @else
                            <li><a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Cerrar sesión
                                        </a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')

        @if(Auth::user())
            <nav class="navbar navbar-inverse navbar-fixed-bottom">
            <div class="container-fluid">
                         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#admin-navbar-collapse">
                        <span class="sr-only">Navegación</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="admin-navbar-collapse">                
                    <ul class="nav navbar-nav navbar-left">
                    <li><a href="/config"><i class="glyphicon glyphicon-cog"></i> Configuración</a></li>
                    </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/config/pages"><i class="glyphicon glyphicon-book"></i> Paginas</a></li>
                    <li><a href="/config/niveles"><i class="glyphicon glyphicon-education"></i> Capacitación</a></li>
                    <li><a href="/config/usuarios"><i class="glyphicon glyphicon-user"></i> Usuarios</a></li>
                    <li><a href="/config/comunicado/create"><i class="glyphicon glyphicon-plus"></i> Nuevo comunicado</a></li>
                </ul>
                </div>
            </div>
        </nav>
        @endif

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
