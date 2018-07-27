<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Iluméxico : {{ config('app.name', 'MUUCH') }}</title>

    <link href="/css/config.css" rel="stylesheet" type="text/css">
    <link href="/css/config.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons">
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    @role('admin')
    <div class="wrapper">
        <div class="sidebar" data-background-color="white" data-active-color="danger">
        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="{{ url('/') }}">
                <img src="/img/logo_h.png" alt="Iluméxico" class="img-responsive" style="padding:5px; height: 39px; margin:0 auto">
                    <h3 class="visuallyhidden">{{ config('app.name', 'MUUCH') }}</h3>
                </a>
            </div>

            <ul class="nav">
                <li id="configuracion" class="active">
                    <a href="/config">
                        <i class="ti-panel"></i>
                        <p>Inicio</p>
                    </a>
                </li>

                <li id="capacitacion">
                    <a href="/config/niveles">
                        <i class="ti-view-list-alt"></i>
                        <p>Capacitación</p>
                    </a>
                </li>
                <li id="categorias">
                    <a href="/config/categoria">
                        <i class="ti-text"></i>
                        <p>Categorías</p>
                    </a>
                </li>
                <li id="consulta">
                    <a href="/config/muuch">
                        <i class="ti-text"></i>
                        <p>Páginas</p>
                    </a>
                </li>
                <li id="contenido">
                    <a href="/config/contenido">
                        <i class="ti-text"></i>
                        <p>Contenido</p>
                    </a>
                </li>
                <li id="canales">
                    <a href="/config/canales">
                        <i class="ti-pencil-alt2"></i>
                        <p>Canales de discusión</p>
                    </a>
                </li>
                <li id="ilucentros">
                    <a href="/config/ilucentros">
                        <i class="ti-pencil-alt2"></i>
                        <p>Ilucentros</p>
                    </a>
                </li>
                <li id="usuarios">
                    <a href="/config/usuarios">
                        <i class="ti-user"></i>
                        <p>Usuarios</p>
                    </a>
                </li>
            </ul>
        </div>
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
                    <a class="navbar-brand" href="#"> <i class="material-icons">@yield('icon')</i> @yield('title') </a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#">
                                <i class="ti-settings"></i>
                            </a>
                        </li>
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


            <div class="content">
                @yield('content')
            </div>

       </div>
    </div>

    @yield('modals')

    <!-- Scripts -->
    <script src="/js/config.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function () {
      $(".nav li").removeClass("active");
      $("#@yield('slug')").addClass("active");
    });
    </script>

    @yield('scripts')

    <script type="text/javascript">
        jQuery.fn.preventDoubleSubmission = function() {
            $(this).on('submit',function(e){
                var $form = $(this);
                if ($form.data('submitted') === true) {
                    e.preventDefault();
                } else {
                    $form.data('submitted', true);
                }
            });
            return this;
        };
    </script>

   @endrole
</body>
</html>
