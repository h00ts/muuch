@extends('layouts.config')
@section('title', 'Editor de Examenes')
@section('icon', 'school')
@section('slug', 'capacitacion')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                 <ul class="breadcrumb">
                  <li><a href="/config/niveles">Capacitación</a></li>
                  <li><a href="/config/niveles/{!! $exam->module->level !!}/edit">Nivel {!! $exam->module->level !!}</a></li>
                  <li class="active">Modulo {!! $exam->module->module !!}</li>
                </ul>
                @include('admin.partials.alerts')
            </div>
            <div class="col-lg-12">

        <div class="panel panel-default">
                    <div class="panel-body row">
                        <div class="col-md-12">
                            <div class="form-inline">
                                <label for="examen">Examen</label>
                                <input type="text" value="{!! $exam->name !!}" class="form-control border-input" id="examen">
                                  <a href="#" class="btn btn-primary pull-right" data-target="#modal-question-create" data-toggle="modal"><i class="material-icons" style="font-size:16px;">add_circle</i> Crear pregunta</a>
                            </div>
                            <hr>
                        </div>
                      <div class="col-md-12">
                          @php($qn=0)
                    @foreach($exam->questions as $question)
                        @php($qn++)
                             <form action="{!! route('pregunta.update', $question->id) !!}" method="POST">
                              {!! csrf_field() !!}
                                <div class="input-group border-input">
                                    <span class="input-group-addon">{{ $qn.'.' }}</span>
                                <input type="hidden" name="_method" value="PUT">
                                <input type="text" name="question-{!! $question->id !!}" value="{!! $question->question !!}" class="form-control border-input" data-toggle="collapse" data-target="#answers-{!! $question->id !!}" aria-expanded="false" aria-controls="answers-{!! $question->id !!}" style="font-weight:bold">
                                    <span class="input-group-addon"></span>
                                </div>
                                        
                            </form>

                <div class="row panel-collapse collapse" id="answers-{!! $question->id !!}">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-sm btn-raised"><i class="material-icons" style="font-size:16px;">save</i> Guardar</button>

                            <button type="button" class="btn btn-inverse btn-sm btn-raised" onclick="set_question('{!! $question->id !!}', '{!! $question->question !!}');" data-target="#modal-answer-create" data-toggle="modal"/><i class="material-icons" style="font-size:16px;">add_circle</i> Agregar Respuesta</button>

                            <button type="button" class="btn btn-raised btn-sm btn-danger pull-right"><i class="material-icons" style="font-size:16px;">delete_forever</i> Eliminar</button>
                            <hr>
                        </div>
                @foreach($question->answers as $answer) 

                        <form action="{!! route('respuesta.update', $answer->id) !!}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="PUT">
                  
                        <div class="row">
                            <div class="col-md-9 form-group form-group-sm">
                                <div class="input-group border-input">
                                        <div class="input-group-addon">
                                                <label style="margin:0">
                                                    <input type="checkbox" name="correct" value="1"{!! ($answer->correct) ? ' checked' : ' ' !!}>
                                                </label>
                                        </div>
                                            <input type="text" name="answer-{!! $answer->id !!}" value="{!! $answer->answer !!}" class="form-control border-input">
                                </div>
                            </div>
                            <div class="col-md-3">
                                    <button type="submit" class="btn btn-success btn-sm btn-raised"><i class="material-icons" style="font-size:16px;">save</i></button>
                                    <button type="button" data-toggle="modal" data-target="#modal-answer-delete" class="btn btn-danger btn-sm btn-raised" onclick="set_delete_answer_modal({!! $answer->id !!}, '{!! $answer->answer !!}')"><i class="material-icons" style="font-size:16px;">delete_forever</i></button>
                            </div>
                        </div>
                        </form>
    
                    
                    


                @endforeach
                    </div>
                </div>



                @endforeach

            </div>
            </div>
            
            </div>
        </div>
    </div>
@endsection
@section('modals')
<div class="modal fade" id="modal-question-create" tabIndex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
                <h4 class="modal-title">Nueva Pregunta</h4>
            </div>
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-lg-12">
                    <form action="{!! route('pregunta.store') !!}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="exam_id" value="{!! $exam->id !!}">
                        <label for="question">Pregunta:</label>
                        <input type="text" class="form-control" name="question">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-8">
                        <button type="submit" class="btn btn-success btn-block">Crear Pregunta</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-question-delete" tabIndex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
                <h4 class="modal-title">Nueva Pregunta</h4>
            </div>
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-lg-12">
                    <form action="{!! route('pregunta.store') !!}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="exam_id" value="{!! $exam->id !!}">
                        <label for="question">Pregunta:</label>
                        <input type="text" class="form-control" name="question">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-8">
                        <button type="submit" class="btn btn-success btn-block">Crear Pregunta</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-answer-create" tabIndex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
                <h4 class="modal-title">Respuesta</h4>
            </div>
            <div class="modal-body">
                <div class="row form-group">
                <div class="col-lg-12">
                    <h4 id="question_answer"></h4>
                </div>
                    <div class="col-lg-12">
                        <form action="{!! route('respuesta.store') !!}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" id="question_id" name="question_id" value="0">
                        <input type="text" class="form-control" name="answer">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-8">
                        <button type="submit" class="btn btn-success btn-block">Crear Respuesta</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-answer-delete" tabIndex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
                <h4 class="modal-title">Respuesta</h4>
            </div>
            <div class="modal-body">
                <div class="row form-group">
                <div class="col-lg-12">
                    <h4 id="question_answer"></h4>
                </div>
                    <div class="col-lg-12">
                        <p>Confirma que deseas borrar: <span id="answer_name"></span></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-8">
                        <form action="{!! route('respuesta.destroy', 0) !!}" method="POST" id="delete_answer">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash text-danger"></i> CONFIRMAR</button> 
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $.material.init();

                function set_question(id, question) {
                $("#question_answer").html(question);
                $("#question_id").attr("value", id);
                }

                function set_delete_answer_modal(id, name) {
                    $("#delete_answer").attr("action", "/config/respuesta/"+id);
                    $("#answer_name").html(name);
                }
</script>
@endsection

