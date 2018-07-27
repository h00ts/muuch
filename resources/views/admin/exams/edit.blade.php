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
                                <form action="/config/examen/{{ $exam->id }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="PUT">
                                    <label for="examen">Examen</label>
                                    <input type="text" value="{!! $exam->name !!}" name="exam_name" class="form-control border-input" id="examen">
                                    <label for="examen">Cal. Mín.</label>
                                    <input type="text" value="{!! $exam->min_score !!}" name="min_score" class="form-control border-input input-sm" id="min_score" style="width: 50px;">
                                    <button type="submit" class="btn btn-primary"><i class="material-icons" style="font-size:16px;">save</i></button>
                                    <a href="#" class="btn btn-info pull-right" data-target="#modal-question-create" data-toggle="modal"><i class="material-icons" style="font-size:16px;">add_circle</i> Crear pregunta</a>
                                </form>
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
                                <input type="text" name="question-{!! $question->id !!}" value="{!! $question->question !!}" class="form-control border-input"  style="font-weight:bold">
                                    <span class="input-group-addon text-info"><a data-toggle="collapse" data-target="#answers-{!! $question->id !!}" aria-expanded="false" aria-controls="answers-{!! $question->id !!}" href="#"><i class="material-icons">arrow_drop_down</i></a></span>
                                </div>
                                        


                <div class="row panel-collapse collapse" id="answers-{!! $question->id !!}">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-sm btn-raised"><i class="material-icons" style="font-size:16px;">save</i> Guardar</button>

                            <button type="button" class="btn btn-inverse btn-sm btn-raised" onclick="set_question('{!! $question->id !!}', '{!! $question->question !!}');" data-target="#modal-answer-create" data-toggle="modal"><i class="material-icons" style="font-size:16px;">add_circle</i> Agregar Respuestas</button>

                            <button type="button" data-toggle="modal" data-target="#modal-answer-delete" class="btn btn-raised btn-sm btn-danger pull-right" onclick="set_delete_question_modal({!! $question->id !!}, '{!! $question->question !!}')"><i class="material-icons" style="font-size:16px;">delete_forever</i> Eliminar</button>
                             </form>
                            <hr>
                        </div>
                @foreach($question->answers as $answer) 

                        <form action="{!! route('respuesta.update', $answer->id) !!}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="PUT">
                  
                        <div class="row">
                            <div class="col-md-10 form-group form-group-sm" style="margin-bottom:0">
                                <div class="input-group border-input"  style="margin-bottom:8px">
                                        <div class="input-group-addon">
                                                <label style="margin:0">
                                                    <input type="checkbox" name="correct" value="1"{!! ($answer->correct) ? ' checked' : ' ' !!}>
                                                </label>
                                        </div>
                                            <input type="text" name="answer-{!! $answer->id !!}" value="{!! $answer->answer !!}" class="form-control border-input">
                                </div>
                            </div>
                            <div class="col-md-2">
                                    <button type="submit" class="btn btn-success btn-sm btn-raised"><i class="material-icons" style="font-size:16px;">save</i></button>
                                    <button type="button" data-toggle="modal" data-target="#modal-answer-delete" class="btn btn-danger btn-sm btn-raised" onclick="set_delete_answer_modal({!! $answer->id !!}, '{!! $answer->answer !!}')"><i class="material-icons" style="font-size:16px;">delete_forever</i></button>
                            </div>
                        </div>
                        </form>
    
                    
                    


                @endforeach
                        <hr>
                    </div>
                </div>

                @endforeach
                <hr> <p>Hay {{ count($exam->answers->where('correct', 1)) }} respuestas correctas de {{ count($exam->answers) }} posibles.</p>
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
                <h4 class="modal-title">Respuestas</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="{!! route('respuesta.store') !!}" method="POST">
                        {!! csrf_field() !!}
                            <label for="question_id">Pregunta</label>
                        <select name="question_id" id="question_id" class="form-control border-input">
                            @foreach($exam->questions as $question)
                                <option value="{{ $question->id }}" selected="false">{{ $question->question }}</option>
                            @endforeach
                        </select> <hr>
                        <div class="form-group" id="question_answer_1">
                            <input type="text" class="form-control border-input" id="answer_answer_1" name="answer_answer_1">
                            <label for="answer-correct">¿Es correcta?</label>
                            <input type="checkbox" name="answer_correct_1" id="answer_correct_1">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-lg-12">
                        <a id="btnCrearRespuesta" class="btn btn-link pull-left" href="#">Agregar Respuesta</a>
                        <button type="submit" class="btn btn-success">Crear Respuesta(s)</button>
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
                    $('#question_id option[value='+id+']').prop("selected", true);
                }

                function set_delete_answer_modal(id, name) {
                    $("#delete_answer").attr("action", "/config/respuesta/"+id);
                    $("#answer_name").html(name);
                }

                function set_delete_question_modal(id, name) {
                    $("#delete_answer").attr("action", "/config/pregunta/"+id);
                    $("#answer_name").html(name);
                }

    $(function() {
        var i = 1;
        $("#modal-answer-create").on("click", "#btnCrearRespuesta", function (e) {
            var original = document.getElementById("question_answer_1");
            var clone = original.cloneNode(true);
            clone.id = "question_answer_" + ++i;
            original.parentNode.appendChild(clone);
            $("#" + clone.id).find("input[type=text]").attr("id", "answer_answer_" + i).attr("name", "answer_answer_" + i);
            $("#" + clone.id).find("input[type=checkbox]").attr("id", "answer_correct_" + i).attr("name", "answer_correct_" + i);
        });

    });
</script>
@endsection

