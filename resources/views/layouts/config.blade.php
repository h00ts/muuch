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
                <a href="{{ url('/config') }}">
                <img src="/img/logo_h.png" alt="Iluméxico" class="img-responsive">
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
                    <a href="/config/muuch">
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

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Navegacion</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#">MUUCH</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="ti-bell"></i>
                                    <p class="notification"></p>
                                    <p></p>
                                    <b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Salir</a></li>
                              </ul>
                        </li>
                        <li>
                            <a href="#">
                                <i class="ti-settings"></i>
                                <p></p>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav> 


            @yield('content')


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="http://www.ilumexico.mx">
                                Iluméxico
                            </a>
                        </li>
                        <li>
                            <a href="/muuch">
                               MUUCH
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script>, hecho con <3 por <a href="mailto:ruslan@ilumexico.mx">Ruslan</a> usando <a href="http://laravel.com">Laravel</a> & <a href="https://material.io">Material Design</a>
                </div>
            </div>
        </footer>
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
