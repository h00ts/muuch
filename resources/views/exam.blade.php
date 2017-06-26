@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <form action="/examen/entrega" method="POST">
            {{ csrf_field() }}
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                @php($qn = 1)
                <div class="panel-body">
                            <h1 class="text-center">Evaluación Nivel {!! $level !!}</h1>
                    @foreach($exams as $exam)
                            @foreach($exam->questions as $question)
                            <div class="form-group">
                                <h4 class="control-label" style="line-height:1.5"><span class="label label-primary">{{ $qn++ }}</span> {!! $question->question !!}</h4>
                                @if($question->answers->sum('correct') > 1)
                                    <p>Selecciona una o más respuestas.</p>
                                    @php($qan=1)
                                    @foreach($question->answers as $answer)
                                     <div class="checkbox">
                                        <label for="e{{ $exam->id }}-q{{ $question->id }}-a{{ $qan++ }}">
                                            <input type="checkbox" name="e{{ $exam->id }}-q{{ $question->id }}-a{!! $answer->id !!}" id="e{{ $exam->id }}-q{{ $question->id }}-a{{ $answer->id }}" value="{!! $answer->id !!}"> {!! $answer->answer !!}
                                        </label> 
                                       </div>
                                     @endforeach
                                @else
                                    <p>Selecciona una sola respuesta.</p>
                                    @foreach($question->answers as $answer)
                                        <div class="radio">
                                            <label for="e{{ $exam->id }}-q{!! $question->id !!}">
                                                <input type="radio" name="e{{ $exam->id }}-q{!! $question->id !!}" value="{!! $answer->id !!}" required="required"> {!! $answer->answer !!}
                                            </label>
                                        </div>
                                         @endforeach
                                    @endif
                                    </div>
                        @endforeach    
                    @endforeach
                    </div>
            </div>
        </div>
        <div class="col-md-10 col-md-offset-1">
            <button type="submit" class="btn btn-lg btn-inverse btn-raised pull-right"><span class="text-success">ENTREGAR <i class="material-icons">arrow_right</i></span></button>
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
    </form>
    </div>
</div>
@endsection

@section('modals')

@endsection

@section('scripts')
<script>
$.material.checkbox();
</script>
@endsection