@extends('layouts.config')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <span class="h4">Noticias</span> | <a href="#">Información general, anuncios y boletines especiales.</a> <span class="pull-right"><a href="#">Archivo</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <a href="/config/consulta" class="link--dashboard">
                            <h3 class="text-center">Consulta</h3>
                        </a>
                        <h1 class="text-center text--yellow"><i class="glyphicon glyphicon-book"></i></h1>
                        <p class="text-center">Paginas de consulta.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <a href="/config/niveles" class="link--dashboard">
                            <h3 class="text-center">Capacitación</h3>
                        </a>
                        <h1 class="text-center text--yellow"><i class="glyphicon glyphicon-education"></i></h1>
                        <p class="text-center">Estructura de capacitación.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <a href="/config/usuarios" class="link--dashboard">
                            <h3 class="text-center">Usuarios</h3>
                        </a>
                        <h1 class="text-center text--yellow"><i class="glyphicon glyphicon-user"></i></h1>
                        <p class="text-center">Activa y asigna roles a usuarios.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="glyphicon glyphicon-pencil"></i> Nueva noticia</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
