@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="text-center">Evaluación de acreditación al nivel {!! $level+1 !!}</h1>
        </div>

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                    @foreach($exams as $exam)
                        <div class="panel-body">
                                @foreach($exam->questions as $question)
                                Pregunta {!! count($exam->questions) - count(Auth::user()->answers) !!} de {!! count($exam->questions) !!}
                                <div class="form-group">
                                    <h3 class="control-label">{!! $question->question !!}</h3>
                                    @if($question->answers->sum('correct') > 1)
                                        <p class="lead">Selecciona una o más respuestas.</p>
                                        @foreach($question->answers as $answer)
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="answer-{!! $question->id !!}" value="{!! $answer->id !!}"> {!! $answer->answer !!}
                                            </label>
                                        </div>
                                         @endforeach
                                    @else
                                        <p>Selecciona una sola respuesta.</p>
                                        @foreach($question->answers as $answer)
                                            <div class="radio">
                                                <label class="lead">
                                                    <input type="radio" name="answer-{!! $question->id !!}" value="{!! $answer->id !!}"> {!! $answer->answer !!}
                                                </label>
                                            </div>
                                             @endforeach
                                        @endif
                                </div>
                            @endforeach
                            
                        </div>
                    @endforeach
                
            </div>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <button type="button" class="btn btn-inverse btn-raised pull-right"><span class="text-success">Siguiente <i class="material-icons">arrow_right</i></span></button>
            <div class="list-group">
              <div class="list-group-item">
                <div class="row-picture">
                  <img class="circle" src="http://lorempixel.com/56/56/people/1" alt="icon">
                </div>
                <div class="row-content">
                  <h4>{!! Auth::user()->name !!}</h4>
                  <p class="list-group-item-text"><strong>Nivel {!! (Auth::user()->level) ? Auth::user()->level : '0' !!}</strong> | Ingeniero comunitario</p>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')

@endsection

@section('scripts')

@endsection