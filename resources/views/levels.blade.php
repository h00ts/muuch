@extends('layouts.app')
@section('content')
    <div class="container">
              <div class="row">
    <div class="col-lg-12">
      <a href="/" class="btn btn-default pull-right">
                        <i class="material-icons">arrow_left</i> Regresar
                    </a> 
      <h3><a href="/capacitacion"><i class="material-icons">school</i> Capacitación</a></h3>
      <hr>
    </div>
  </div>
        <div class="row">
            <div class="col-md-4">
                @include('layouts.profile')
                @if($user->level === null)
                    <p>Inscríbete a nuestra plataforma de capacitación para subir al nivel 1.</p>
                    <a href="/capacitacion/inscribir" class="btn btn-default btn-raised btn-block"><i class="material-icons">school</i>  Inscribirme</a>
                @else
                    <h4 class="text-info">Nivel {!! ($user->level) ? $user->level : '0' !!} <span class="label pull-right">{!! isset($user_content) ? number_format($user_content / $content_count * 100) . '%' : '0%' !!}</span></h4>
                    <div class="progress progress-striped active">
                        <div class="progress-bar {!! ($user_content == $content_count) ? 'progress-bar-primary' : 'progress-bar-warning' !!}" role="progressbar"
                             style="width: {!! ($user_content) ? ($user_content / $content_count * 100).'%' : '0%' !!};"
                             aria-valuenow="{!! ($user_content) ? number_format($user_content / $content_count * 100, 2, '.', ',')  : '0' !!}"
                             aria-valuemin="0"
                             aria-valuemax="100">
                            {!! ($user_content) ? number_format($user_content / $content_count * 100, 0, '.', ',') . '%' : '0%' !!}
                        </div>
                    </div>
                {{--
                    @if($user_content == $content_count && count($user->scores) && \Carbon\Carbon::now()->subWeeks(2) > $user->scores->last()->created_at)
                        <h4 class="text-success"><i class="material-icons">thumb_up</i> ¡Buen trabajo!</h4>
                        <a href="/examen" class="btn btn-inverse btn-raised btn-block"><i class="material-icons">trending_up</i> TOMA EL EXAMEN</a>
                        <p>Toma el examen para pasar al siguiente nivel.</p>
                    @elseif($user_content == $content_count && count($user->scores) && \Carbon\Carbon::now()->subWeeks(2) < $user->scores->last()->created_at)
                        <p class="text-danger">Espera {{ \Carbon\Carbon::parse($user->scores->last()->created_at)->addWeeks(2)->diffInDays(\Carbon\Carbon::now()) }} dias para tomar tu examen nuevamente. Aprovecha para repasar el contenido de tu capacitación.</p>
                    @elseif($user_content == $content_count && !count($user->scores))
                        <h4 class="text-success"><i class="material-icons">thumb_up</i> ¡Buen trabajo!</h4>
                        <a href="/examen" class="btn btn-inverse btn-raised btn-block"><i class="material-icons">trending_up</i> TOMA EL EXAMEN</a>
                        <p>Toma el examen para pasar al siguiente nivel.</p>
                    @endif
                    --}}
                @endif
                @include('admin.partials.alerts')
                <p><strong>¡Bienvenido a la capacitación MUUCH!</strong></p> <p>Aquí te guiaremos por el material que necesitas conocer para subir al siguente nivel. </p> <p> Marca el material que hayas leído y entendido con el botón verde que dice "Completar". </p> <p> Una vez completado el material de un modulo, podrás tomar el examen para evaluar tu entendimiento de los temas del modulo.</p>
            </div>
            <div class="col-md-8">
                @foreach($modules as $module)
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Nivel {!! $module->level !!}, Módulo {!! ($module->module > 9) ? $module->module : '0'.$module->module !!}</h3>
                        </div>
                        <div class="panel-body">
                    <p>{!! isset($module->description) ? $module->description : ' ' !!}</p>
                            <hr>
                            @if(count($module->contents) <= count($user->content->where('module_id', $module->id)))
                                @foreach($module->exams as $exam)
                                    @if(!count($user->scores->where('exam_id', $exam->id)->last()) || count($user->scores->where('exam_id', $exam->id)->last()) && $user->scores->where('exam_id', $exam->id)->last()->created_at < Carbon\Carbon::today()->subWeek())
                                        <a href="/examen/{{ $exam->id }}" class="btn btn-info btn-lg btn-block"><i class="material-icons">check_box</i> Toma el Exámen de: {{ $exam->name }}</a> <hr>
                                    @elseif($user->scores->where('exam_id', $exam->id)->last() && $user->scores->where('exam_id', $exam->id)->last()->passed)
                                        <div class="alert alert-success alert-dismissible" role="alert">
                                            <strong><i class="glyphicon glyphicon-check text-success"></i></strong> ¡Felicidades! pasaste {{ $exam->name }} con un puntaje de {{ $user->scores->where('exam.module_id', $module->id)->first()->percent.' de 100' }}.
                                        </div>
                                    @elseif($user->scores->where('exam_id', $exam->id)->last() && !$user->scores->where('exam_id', $exam->id)->last()->passed)
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <strong><i class="glyphicon glyphicon-close text-danger"></i></strong> Espera {{ Carbon\Carbon::today()->subWeeks(2)->diffInDays($user->scores->where('exam_id', $exam->id)->last()->created_at) }} días para volver a tomar el examen de {{ $exam->name }} ({{ $user->scores->where('exam.module_id', $module->id)->last()->percent.'/100' }}).
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                <div class="list-group">
                @foreach($module->contents as $content)
                        <div class="list-group-item">
                                @if($content->users->contains($user->id))
                                    <div class="row-action-primary">
                                        <i class="material-icons" style="background:green">check</i>
                                    </div>
                                    <div class="row-content">
                                        <div class="action-secondary">
                                            <a href="{{ ($content->markdown != null) ? '/capacitacion/ver/'.$content->id : $content->file }}" {{ ($content->markdown == null) ? 'target="_blank"' : '' }}><span class="label label-info">Consultar</span></a>
                                        </div>
                                        <h4 class="list-group-item-heading">
                                                <s>{!! $content->name !!}</s>
                                        </h4>
                                        <p class="list-group-item-text">
                                            Completado. 
                                        </p>
                                    </div>
                                @else
                                    <div class="row-picture">
                                        <a href="{{ ($content->markdown != null) ? '/capacitacion/ver/'.$content->id : $content->file }}" {{ ($content->markdown == null) ? 'target="_blank"' : '' }}>
                                            <img src="{!! $content->cover !!}" alt="{!! $content->name !!}" class="circle">
                                        </a>
                                    </div>
                                    <div class="row-content">
                                        <div class="action-secondary">
                                            <span class="label label-success" data-target="#modal-complete" data-toggle="modal" onclick="set_content_modal({!! $content->id !!}, '{!! $content->name !!}')">Completar</span>
                                        </div>
                                        <h4 class="list-group-item-heading">
                                            <a href="{{ ($content->markdown != null) ? '/capacitacion/ver/'.$content->id : $content->file }}" {{ ($content->markdown == null) ? 'target="_blank"' : '' }}>
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
                <h4 class="modal-title">Estás completando:</h4>
            </div>
            <div class="modal-body">
                <p class="text-center h3" id="content_name"></p>
                <p>Asegúrate de haber leído y entendido el contenido dentro de este bloque antes de completarlo.</p>
            </div>
            <div class="modal-footer">
                    <form action="/capacitacion/completar/" method="POST" id="complete_content">
                    {!! csrf_field() !!}
                    <button type="submit" class="btn btn-success btn-raised"><i class="glyphicon glyphicon-check"></i> He leído y comprendido este bloque</button>
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
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();

      $('#complete_content').preventDoubleSubmission();

    })
</script>
@endsection