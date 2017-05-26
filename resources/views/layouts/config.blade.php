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
    <link href="/css/config.css" rel="stylesheet">
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
    <div id="wrapper">
        <div class="sidebar" data-background-color="white" data-active-color="danger">
        @if(Auth::user())
        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="{{ url('/muuch') }}">
                <img src="/img/logo.png" alt="Iluméxico" class="img-responsive">
                    <h3 class="visuallyhidden">{{ config('app.name', 'MUUCH') }}</h3>
                </a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="/config">
                        <i class="ti-panel"></i>
                        <p>Configuracion</p>
                    </a>
                </li>
                <li>
                    <a href="/config/usuarios">
                        <i class="ti-user"></i>
                        <p>Usuarios</p>
                    </a>
                </li>
                <li>
                    <a href="/config/niveles">
                        <i class="ti-view-list-alt"></i>
                        <p>Capacitación</p>
                    </a>
                </li>
                <li>
                    <a href="/config/paginas">
                        <i class="ti-text"></i>
                        <p>MUUCH</p>
                    </a>
                </li>
                <li>
                    <a href="icons.html">
                        <i class="ti-pencil-alt2"></i>
                        <p>Foro</p>
                    </a>
                </li>
            </ul>
        </div>
        @endif
    </div>

       <div class="main-panel">
            @yield('content')
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
