@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text--page-title text-center">
                    <h2><i class="glyphicon glyphicon-education"></i> Capacitación</h2>
                </div>
            </div>
            <div class="col-md-4">
                @if($user->level)
                    <h2 class="text--page-label">Nivel {!! $user->level !!}</h2>
                @endif
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3><i class="glyphicon glyphicon-user"></i> {!! $user->name !!}</h3>
                        <p><i class="glyphicon glyphicon-star"></i> Administrador</p>
                        <p><i class="glyphicon glyphicon-envelope"></i> {!! $user->email !!}</p>
                        @if($user->level === null)
                            <p>Bienvenido a la plataforma de capacitación MUUCH.</p>
                            <p>Inscribete haciendo clic en el boton inferior para comenzar tu proceso de capacitacion.</p>
                            <a href="/capacitacion/inscribir" class="btn btn-success">Inscribirme</a>
                            @else
                            <strong>Has completado este nivel al</strong>

                            <div class="progress">
                              <div class="progress-bar {!! (count($user->content) == $content_count) ? 'progress-bar-success' : '' !!}" role="progressbar" aria-valuenow="{!! isset($user->content) ? number_format(count($user->content) / $content_count * 100, 2, '.', ',')  : '0' !!}" aria-valuemin="0" aria-valuemax="100" style="width: {!! isset($user->content) ? count($user->content) / $content_count * 100 . '%' : '0%' !!};">
                                {!! isset($user->content) ? number_format(count($user->content) / $content_count * 100, 0, '.', ',') . '%' : '0%' !!}
                              </div>
                            </div>

                            @if(count($user->content) == $content_count)
                                <h2 class="text-success"><i class="glyphicon glyphicon-ok"></i> ¡Buen trabajo!</h2>
                            <p>Terminaste de estudiar los modulos, ahora toma el examen para pasar al siguiente nivel.</p>
                                <a href="#" class="btn btn-success btn-block btn-lg"><i class="glyphicon glyphicon-edit"></i> EXAMEN</a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                @include('admin.partials.alerts')
                @foreach($modules as $module)
                    <h3 class="text--page-label">Modulo {!! ($module->module > 9) ? $module->module : '0'.$module->module !!}</h3>
                    <p>{!! isset($module->description) ? $module->description : ' ' !!}</p>
                <div class="row">
                @foreach($module->contents as $content)
                    <div class="col-lg-12">
                        <div class="module__container">
                            <img src="{!! $content->cover !!}" alt="{!! $content->name !!}" class="img-responsive module__img">
                                <h1 class="panel-title"><a href="/capacitacion/ver/{!! $content->id !!}" class="btn btn-link btn-block"><i class="glyphicon glyphicon-book"></i>  <span class="h4">{!! $content->name !!}</span></a></h1>

                                @if(! $content->users->contains($user->id))
                                <div class="panel-body text-center">
                                    <a href="/capacitacion/ver/{!! $content->id !!}">
                                        <img src="{!! $content->cover !!}" alt="{!! $content->name !!}" class="img-responsive">
                                    </a>
                                </div>
                                @endif

                            <div class="panel-footer">
                                <div class="row">
                                @if($content->users->contains($user->id))
                                    <div class="col-md-12 text-center text-success bg-success">
                                        <i class="glyphicon glyphicon-ok"></i> COMPLETADO
                                    </div>
                                @else
                                    <div class="col-md-6 text-center">
                                        <button class="btn btn-link" data-target="#modal-complete" data-toggle="modal" onclick="set_content_modal({!! $content->id !!}, '{!! $content->name !!}')"><i class="glyphicon glyphicon-unchecked"></i> Marcar completado</button>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <a href="{!! $content->file !!}" target="_blank" class="btn btn-link"><i class="glyphicon glyphicon-download"></i> Descargar</a>
                                    </div>
                                @endif  
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