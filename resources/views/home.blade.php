@extends('layouts.app')

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
         <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <a href="/consulta" class="link--dashboard">
                        <h3 class="text-center">Consulta</h3>
                    </a>                        
                    <h1 class="text-center text--yellow"><i class="glyphicon glyphicon-heart"></i></h1>
                    <p class="text-center">Material de consulta.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <a href="/capacitacion" class="link--dashboard">
                        <h3 class="text-center">Capacitación</h3>
                    </a>
                    <h1 class="text-center text--yellow"><i class="glyphicon glyphicon-education"></i></h1>
                    <p class="text-center">Curso de capacitación.</p>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <ul class="nav navbar-nav">
                        <li><a href="/admin"><i class="glyphicon glyphicon-cog"></i> Administración</a></li>
                        <li><a href="/admin/pages"><i class="glyphicon glyphicon-book"></i> Paginas</a></li>
                        <li><a href="/admin/niveles"><i class="glyphicon glyphicon-education"></i> Capacitación</a></li>
                        <li><a href="/admin/usuarios"><i class="glyphicon glyphicon-user"></i> Usuarios</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
