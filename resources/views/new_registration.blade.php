<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Iluméxico : Muuch</title>

        <!-- Fonts -->
        <link href="/css/app.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #f4f3ef;
                color: #636b6f;
                font-family: 'Montserrat', sans-serif;
                font-weight: 300;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 32px;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            p {
                font-size: 21px;
                padding: 1em;
            }
        </style>
    </head>
    <body>
        <div class="app">
            <nav class="navbar navbar-inverse navbar-static-top">
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
                    <a href="#" class="navbar-brand">
                    <img src="/img/logo_h.png" alt="Iluméxico" style="height:40px;">
                        <h3 class="visuallyhidden">{{ config('app.name', 'MUUCH') }}</h3>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ url('/logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                Salir <i class="material-icons">exit_to_app</i>
                            </a>
                            <form id="logout-form" action="/salir" method="POST">{{ csrf_field() }}</form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
            <div class="content">
                <div class="title m-b-md">
                    <img src="data:image/svg+xml;utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%3E%3Cpath%20d%3D%22M0%2011c2.76.575%206.312%201.688%209%203.438C12.157%2010.208%2017.828%206.25%2024%203c-5.86%205.775-10.71%2012.328-14%2018.917C7.35%2018.15%204.453%2014.647%200%2011z%22%2F%3E%3C%2Fsvg%3E" alt="swish">
                     <br> Te has registrado correctamente.
                </div>

                <div class="box">
                   <div class="box-body" style="max-width:600px; margin: 0 auto">
                       <p>Porfavor espera a que tu cuenta sea aprobada. <br> <strong>Te lo notificaremos a tu correo de Iluméxico.</strong></p>
                       <p><a href="{{ url('/logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                Salir <i class="material-icons">exit_to_app</i>
                            </a></p>
                   </div>
                </div>
            </div>
        </div>
    </body>
</html>
