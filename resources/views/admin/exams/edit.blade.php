@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center"><i class="glyphicon glyphicon-education"></i> Capacitación</h2>
            </div>
            <div class="col-lg-12">
                <h3><i class="glyphicon glyphicon-cog"></i> <a href="/config">Configuración</a> / <a href="/config/niveles">Niveles</a> / <a href="/config/niveles/{!! $exam->module->level !!}/edit">Nivel {!! $exam->module->level.'</a> &rarr; Examen '.$exam->name !!}</h3>
                @include('admin.partials.alerts')
            </div>
            <div class="col-lg-12">

        <div class="panel panel-default">
                    <div class="panel-body">
                      <div class="col-md-12">   
                            @foreach($exam->questions as $question)
                      <div class="panel panel-default">  
                      <div class="panel-body">     
                      <div class="row">
                         <form action="{!! route('pregunta.update', $question->id) !!}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="col-xs-12">
                        <input type="text" name="question-{!! $question->id !!}" value="{!! $question->question !!}" class="form-control lead" style="font-weight:bold">
                        <button type="submit" class="btn btn-link" style="position:absolute; right:15px; top: 0"><i class="glyphicon glyphicon-floppy-disk"></i></button>
                        </div>
                        </form>
        
                     </div>
                <div class="row">
                @foreach($question->answers as $answer) 
      <div class="col-xs-12">
                        <form action="{!! route('respuesta.update', $answer->id) !!}" method="POST">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="PUT">
                  
                        <div class="row">
                            <div class="col-lg-8">
                                <input type="text" name="answer-{!! $answer->id !!}" value="{!! $answer->answer !!}" class="form-control">
                                <button type="submit" class="btn btn-link" style="position:absolute; right:15px; top: 0"><i class="glyphicon glyphicon-floppy-disk"></i></button>
                            </div>
                            <div class="col-lg-4">
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default">
                                        <input type="radio" name="year" value="2011">Correcta
                                    </label>
                                    <label class="btn btn-default active">
                                        <input type="radio" name="year" value="2013" checked="">Incorrecta
                                    </label>
                                </div>
                            </div>
                        </div>
    
                
                        </form>
    
                        <form action="/config/answers/{!! $answer->id !!}" method="POST" style="position:absolute; right:15px; top: 0">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-link text-danger"><i class="glyphicon glyphicon-trash text-danger"></i></button> 
                        </form>
                    
                        </div>

                @endforeach
                </div>
                </div>
                <div class="panel-footer">
                    <a href="#" class="btn" onclick="set_question('{!! $question->id !!}', '{!! $question->question !!}');" data-target="#modal-answer-create" data-toggle="modal"/><i class="glyphicon glyphicon-plus"></i> Crear Respuesta</a>
                        <form action="/config/questions/{!! $question->id !!}" method="POST" class="pull-right">
                            {!! csrf_field() !!}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-link text-danger"><i class="glyphicon glyphicon-close"></i> Borrar pregunta</button> 
                            </form>
                </div>
                </div>    



                @endforeach

            </div>
            </div>
                    <div class="panel-footer">
                        <a href="#" class="btn btn-primary" data-target="#modal-question-create" data-toggle="modal"><span class="fa fa-plus"></span> Crear pregunta</a>
                        <a href="#" class="btn btn-link"><i class="glyphicon glyphicon-eye-open"></i> Vista previa</a>
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
        <script>
             function set_question(id, question) {
            $("#question_answer").html(question);
            $("#question_id").attr("value", id);
            }

        </script>
@endsection

