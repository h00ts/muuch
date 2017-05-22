@extends('layouts.app')
@section('content')
<div class="container">

    <div class="row">
         <div class="col-md-12">
            <h2><strong>MUUCH</strong>
                <a href="/consulta" class="btn btn-primary">
                    <i class="material-icons">folder</i> Todo el material
                </a> 
            </h2>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Accesos rapidos</h3></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <ul class="nav nav-pills nav-stacked">
                      <li class="active"><a href="#consulta" data-toggle="tab">CONSULTA</a></li>
                      <li><a href="#formatos" data-toggle="tab">FORMATOS</a></li>
                      <li><a href="#cultura" data-toggle="tab">CULTURA</a></li>
                      <li><a href="#equipo" data-toggle="tab">EQUIPO</a></li>
                    </ul>
                        </div>
                        <div class="col-sm-8">
                            <div id="myTabContent" class="tab-content">
                                <hr>
                              <div class="tab-pane fade active in" id="consulta">
                                <a href="#" class="btn btn-default btn-sm">Manuales, guias y guiones</a>
                                <a href="#" class="btn btn-default btn-sm">Videos</a>
                                <a href="#" class="btn btn-default btn-sm">Herramientas</a>
                              </div>
                              <div class="tab-pane fade" id="formatos">
                                
                              </div>
                              <div class="tab-pane fade" id="cultura">
                               
                              </div>
                              <div class="tab-pane fade" id="equipo">
                                
                              </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                       <h3 class="panel-title"> <i class="material-icons small">face</i> {!! $user->name !!}</h3>
                    </div>
                    <div class="panel-body">
                        <p><span class="lead"><strong>Nivel {!! $user->level !!}</strong> | Ingeniero comunitario </span></p>
                        @if($user->level === null)
                            <p>Bienvenido a la plataforma de capacitación MUUCH.</p>
                            <p>Inscribete haciendo clic en el boton inferior para comenzar tu proceso de capacitacion.</p>
                            <a href="/capacitacion/inscribir" class="btn btn-success">Inscribirme</a>
                            @else
                            <strong>Completado: {!! isset($user->content) ? count($user->content) / $content_count * 100 . '%' : '0%' !!}</strong>

                            <div class="progress">
                              <div class="progress-bar {!! (count($user->content) == $content_count) ? 'progress-bar-success' : '' !!}" role="progressbar" aria-valuenow="{!! isset($user->content) ? number_format(count($user->content) / $content_count * 100, 2, '.', ',')  : '0' !!}" aria-valuemin="0" aria-valuemax="100" style="width: {!! isset($user->content) ? count($user->content) / $content_count * 100 . '%' : '0%' !!};">
                                {!! isset($user->content) ? number_format(count($user->content) / $content_count * 100, 0, '.', ',') . '%' : '0%' !!}
                              </div>
                            </div>

                            <a href="/capacitacion" class="btn btn-primary btn-block">
                            <i class="material-icons">school</i> Mi Capacitación
                        </a>

                            @if(count($user->content) == $content_count)
                                <h2 class="text-success"><i class="glyphicon glyphicon-ok"></i> ¡Buen trabajo!</h2>
                            <p>Terminaste de estudiar los modulos, puedes tomar el examen.</p>
                                <a href="#" class="btn btn-primary btn-block btn-lg"><i class="glyphicon glyphicon-edit"></i> EXAMEN</a>
                            @endif
                        @endif
                    </div>

                </div>

        </div>
        <div class="col-lg-12 text-center">
            <h2><i class="material-icons">accessibility</i></h2>
            <h4>La palabra MUUCH proviene del maya y significa "juntos". </h4>
            <p>
Esta plataforma fué creada con la intención de acercarnos y ayudarnos a construir un mejor ILUMÉXICO JUNTOS.<br> Te invitamos a explorar la plataforma, así como a enviarnos todos tus comentarios para enriquecerla.</p>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection