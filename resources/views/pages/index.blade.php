@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
                <div class="col-md-12">
                     <a href="/muuch" class="btn btn-default pull-right">
                        <i class="material-icons">arrow_left</i> Regresar
                    </a> 
                    <h2><strong>MUUCH</strong></h2>
                </div>

            @foreach($categories->where('parent_id', null) as $category)
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4 bg-primary">
                                <h4>{{ $category->name }}</h4>
                            </div>
                            <div class="col-md-8">
                                @foreach($categories->where('parent_id', $category->id) as $subcategory)
                                    <a href="/muuch/cat/{{ $subcategory->id }}" class="btn btn-default btn-block">{{ $subcategory->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <!--
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4 bg-primary">
                                <h4>FORMATOS</h4>
                            </div>
                            <div class="col-md-8">
                                <a href="#" class="btn btn-default btn-block">Campo</a>
                                <a href="#" class="btn btn-default btn-block">Coordinacion regional</a>
                                <a href="#" class="btn btn-default btn-block">Institucionales</a>
                                <a href="#" class="btn btn-default btn-block">Oficinas centrales</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4 bg-primary">
                                <h4>CULTURA</h4>
                            </div>
                            <div class="col-md-8">
                                    <a href="#" class="btn btn-default btn-block">Publicaciones</a>
                                    <a href="#" class="btn btn-default btn-block">Prensa</a>
                                    <a href="#" class="btn btn-default btn-block">Guias de conducta</a>
                                    <a href="#" class="btn btn-default btn-block">Informacion general</a>
                                <hr>
                                    <a href="#" class="btn btn-default btn-block">Pobreza energetica</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4 bg-primary">
                                <h4>EQUIPO</h4>
                            </div>
                            <div class="col-md-8">
                                    <a href="#" class="btn btn-default btn-block">Personas</a>
                                    <a href="#" class="btn btn-default btn-block">Sucursales</a>
                                    <a href="#" class="btn btn-default btn-block">Directorio</a>
                                    <a href="#" class="btn btn-default btn-block">Canales de comunicacion</a>
                                    <a href="#" class="btn btn-default btn-block">Quejas y sugerencias</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        -->
    </div>

@endsection