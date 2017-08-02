@extends('layouts.config')
@section('title', 'Ilucentros')
@section('icon', 'build')
@section('slug', 'ilucentros')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('admin.partials.alerts')
            </div>
            <div class="col-lg-12">
                            <button class="btn btn-primary" data-target="#modal-ilucentro-create" data-toggle="modal"><i class="glyphicon glyphicon-plus"></i> Crear Ilucentro</button>
           <hr>
                <div class="card">
                    <div class="header">
                        <h4 class="title">Ilucentros</h4>
                    </div>
                    <div class="content">
                            <table class="table table-striped">
                                <thead>
                                <td>ID</td>
                                <td>Nombre</td>
                                <td>Ubicación</td>
                                <td>Coordenadas</td>
                                <td></td>
                                </thead>
                                @foreach($ilucentros as $ilu)
                                    <tr>
                                        <td>{{ $ilu->id }}</td>
                                        <td>{{ $ilu->name }} ({{ $ilu->short_name }})</td>
                                        <td>{{ $ilu->direccion }}, {{ $ilu->municipio }}, {{ $ilu->estado }}</td>
                                        <td>{{ $ilu->coordinates }}</td>
                                        <td><a href="/config/ilucentros/{{ $ilu->id }}/edit">Editar</a></td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </table>
                    </div>
                </div>
             </div>
            
        </div>
    </div>
@endsection
@section('modals')
<div class="modal fade" id="modal-ilucentro-create" tabIndex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
                <h4 class="modal-title">ILUCentro</h4>
            </div>
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-lg-12">
                    <form action="{!! route('ilucentros.store') !!}" method="POST">
                        {!! csrf_field() !!}
                        <div class="form-group"><label for="name">Nombre:</label>
                        <input type="text" class="form-control" name="name"></div>
                        <div class="form-group"><label for="short_name">Abreviación:</label>
                        <input type="text" class="form-control" name="short_name"></div>
                        <div class="form-group"><label for="name">Dirección:</label>
                        <input type="text" class="form-control" name="direccion"></div>
                        <div class="form-group"><label for="name">Municipio / Localidad:</label>
                        <input type="text" class="form-control" name="municipio"></div>
                        <div class="form-group"><label for="name">Estado:</label>
                        <input type="text" class="form-control" name="estado"></div>
                        <div class="form-group"><label for="name">Coordenadas:</label>
                        <input type="text" class="form-control" name="coordinates" placeholder="ej. ['13.3242', '-42.34234']"></div>
                        <button type="submit" class="btn btn-primary">Crear ILUCentro</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection