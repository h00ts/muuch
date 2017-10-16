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
                <div class="card">
                    <div class="header">
                        <h4 class="title">Editar Ilucentro</h4>
                    </div>
                    <div class="content">
                            <form action="{{ route('ilucentros.update', $id) }}" method="POST" enctype="multipart/form-data">
                                {!! csrf_field() !!}
                                <input type="hidden" name="_method" value="PUT">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label for="name">Nombre</label>
                                            <input type="text" class="form-control border-input" name="name" value="{!! $name !!}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="short_name">Abreviación</label>
                                            <input type="text" class="form-control border-input" name="short_name" value="{!! $short_name !!}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="coordinates">Coordenadas</label>
                                            <input type="text" class="form-control border-input" name="coordinates" value="{!! $coordinates !!}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="direccion">Direccion</label>
                                            <input type="text" class="form-control border-input" name="direccion" value="{!! $direccion !!}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="municipio">Municipio</label>
                                            <input type="text" class="form-control border-input" name="municipio" value="{!! $municipio !!}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="estado">Estado</label>
                                            <input type="text" class="form-control border-input" name="estado" value="{!! $estado !!}">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <a class="btn btn-danger pull-right" id="eliminar-ilucentro" href="#" data-target="#modal-ilucentro-destroy" data-toggle="modal" data-ilucentro="{{ $id }}" data-iluname="{{ $name }}"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>
                                <button class="btn btn-success" type="submit"><i class="material-icons">save</i> Guardar Ilucentro</button>
                            </form>
                    </div>
                </div>
             </div>
            
        </div>
    </div>
@endsection
@section('modals')
<div class="modal fade" id="modal-ilucentro-destroy" tabIndex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
                <h4 class="modal-title text-danger">Eliminar {{ $name }}</h4>
            </div>
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-lg-12">
                    <form action="{!! route('ilucentros.destroy', $id) !!}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger"><i class="glyphicon glphicon-trash"></i> Eliminar ILUCentro</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection