@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                    <h2><i class="glyphicon glyphicon-education"></i> <strong>CAPACITACIÓN</strong></h2>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
       
                    <div class="panel-body">
                        <p><span class="lead"><strong>Nivel {!! $user->level !!}</strong> | Ingeniero comunitario {!! $user->name !!}</span></p>
                        @if($user->level === null)
                            <p>Bienvenido a la plataforma de capacitación MUUCH.</p>
                            <p>Inscribete haciendo clic en el boton inferior para comenzar tu proceso de capacitacion.</p>
                            <a href="/capacitacion/inscribir" class="btn btn-inverse btn-raised btn-block"><i class="material-icons">school</i>  Inscribirme</a>
                            @else
                            <strong>Completado: {!! isset($user->content) ? count($user->content) / $content_count * 100 . '%' : '0%' !!}</strong>

                            <div class="progress">
                              <div class="progress-bar {!! (count($user->content) == $content_count) ? 'progress-bar-primary' : 'progress-bar-warning' !!}" role="progressbar" aria-valuenow="{!! isset($user->content) ? number_format(count($user->content) / $content_count * 100, 2, '.', ',')  : '0' !!}" aria-valuemin="0" aria-valuemax="100" style="width: {!! isset($user->content) ? count($user->content) / $content_count * 100 . '%' : '0%' !!};">
                                {!! isset($user->content) ? number_format(count($user->content) / $content_count * 100, 0, '.', ',') . '%' : '0%' !!}
                              </div>
                            </div>

                            @if(count($user->content) == $content_count)
                                <h2 class="text-success"><i class="glyphicon glyphicon-ok"></i> ¡Buen trabajo!</h2>
                            <p>Terminaste de estudiar los modulos, puedes tomar el examen.</p>
                                <a href="#" class="btn btn-inverse btn-raised btn-block"><i class="glyphicon glyphicon-edit"></i> TOMAR EXAMEN</a>
                            @endif
                        @endif
                    </div>

                </div>
            </div>
            <div class="col-md-8">
                @include('admin.partials.alerts')
                @foreach($modules as $module)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Modulo {!! ($module->module > 9) ? $module->module : '0'.$module->module !!}</h3>
                        </div>
                        <div class="panel-body">
                            
                    <p>{!! isset($module->description) ? $module->description : ' ' !!}</p>
                <div class="list-group">
                @foreach($module->contents as $content)
                        <div class="list-group-item">
                                @if($content->users->contains($user->id))
                                    <div class="row-action-primary">
                                        <i class="material-icons" style="background:green">check</i>
                                    </div>
                                    <div class="row-content">
                                        <div class="action-secondary">
                                            <a href="/capacitacion/ver/{!! $content->id !!}"><i class="material-icons">arrow_right</i></a>
                                        </div>
                                        <h4 class="list-group-item-heading">
                                                <s>{!! $content->name !!}</s>
                                        </h4>
                                        <p class="list-group-item-text">
                                            Completado. 
                                            {!! $content->description !!}  
                                        </p>
                                    </div>
                                @else
                                    <div class="row-picture">
                                        <a href="/capacitacion/ver/{!! $content->id !!}">
                                            <img src="{!! $content->cover !!}" alt="{!! $content->name !!}" class="circle">
                                        </a>
                                    </div>
                                    <div class="row-content">
                                        <div class="action-secondary" data-target="#modal-complete" data-toggle="modal" onclick="set_content_modal({!! $content->id !!}, '{!! $content->name !!}')"><i class="material-icons" >radio_button_unchecked</i></div>
                                        <h4 class="list-group-item-heading">
                                    <a href="/capacitacion/ver/{!! $content->id !!}">
                                        {!! $content->name !!}</a>
                                </h4>
                                <p class="list-group-item-text"> {!! $content->description !!}  <a href="{!! $content->file !!}" target="_blank"><i class="glyphicon glyphicon-download"></i> Descargar</a></p>
                            </div>
                                @endif
                        </div>
                        <div class="list-group-separator"></div>
                    @endforeach
                </div>
            </div>
        </div>
                @endforeach
                <h1 class="text-center text-muted"><i class="glyphicon glyphicon-education"></i></h1>
            </div>
        </div>
    </div>
@endsection

@section('modals')
<div class="modal fade" id="modal-complete" tabIndex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
                <h4 class="modal-title">Confirma que has completado:</h4>
            </div>
            <div class="modal-body">
                <h4 class="text-center" id="content_name"></h4>
            </div>
            <div class="modal-footer">
                    <form action="/capacitacion/completar/" method="POST" id="complete_content">
                    {!! csrf_field() !!}
                    <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-check"></i> Confirmar y completar</button>
                   <button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    function set_content_modal(id, name) {
        $("#complete_content").attr("action", "/capacitacion/completar/"+id);
        $("#content_name").html(name);
    }
</script>
@endsection