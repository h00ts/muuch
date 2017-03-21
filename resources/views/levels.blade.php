@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4>{!! $user->name !!}</h4>
                        <p>{!! $user->email !!}</p>

                        @if($user->level === null)
                            <p>Bienvenido a la plataforma de capacitación MUUCH.</p>
                            <p>Inscribete haciendo clic en el boton inferior para comenzar tu proceso de capacitacion.</p>
                            <a href="/capacitacion/inscribir" class="btn btn-success">Inscribirme</a>
                        @else
                            <h3>Nivel {!! $user->level !!}</h3>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                @include('admin.partials.alerts')
                @foreach($modules as $module)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1 class="panel-title">Modulo {!! ($module->module > 9) ? $module->module : '0'.$module->module !!}</h1>
                    </div>
                    <div class="panel-body">
                        {!! $module->description !!}
                    </div>
                </div>
                <div class="row">
                @foreach($module->contents as $content)
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h1 class="panel-title"><a href="/capacitacion/ver/{!! $content->id !!}" class="btn btn-link btn-block"><i class="glyphicon glyphicon-book pull-left"></i>  <span class="h4">{!! $content->name !!}</span> <span class="label label-default pull-right"> &rarr; </span></a></h1>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6 text-center">
                                        <a href="" class="btn btn-link">Marcar completado</a>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <a href="" class="btn btn-link">Descargar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endforeach
                <h1 class="text-center text-muted"><i class="glyphicon glyphicon-education"></i></h1>
            </div>
        </div>
    </div>
@endsection