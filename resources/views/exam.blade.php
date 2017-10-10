@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <form action="/examen/entrega" method="POST">
            {{ csrf_field() }}
            <div class="col-md-10 col-md-offset-1">
                <button type="submit" class="btn btn-lg btn-inverse btn-raised pull-right"><span class="text-success">TERMINAR <i class="material-icons">arrow_right</i></span></button>
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
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                @php($qn = 1)
                <div class="panel-body">
                            <h2 class="text-center">Evaluación Nivel {!! $level !!}</h2>
                    @foreach($exams as $exam)
                            <h4 class="text-center">Modulo {{ '0'.$exam->module->module }}</h4>
                        <hr>
                            @foreach($exam->questions as $question)
                            <div class="form-group">
                                <h4 class="control-label" style="line-height:1.5"><span class="label label-primary">{{ $qn++ }}</span> {!! $question->question !!}</h4>
                                @if($question->answers->sum('correct') > 1)
                                    <small>Selecciona todas las que aplíquen.</small>
                                    @php($qan=1)
                                    @foreach($question->answers->shuffle() as $answer)
                                     <div class="checkbox">
                                        <label class="validate-question">
                                            <input type="checkbox" name="e{{ $exam->id }}-q{{ $question->id }}-a{!! $answer->id !!}" id="e{{ $exam->id }}-q{{ $question->id }}-a{{ $answer->id }}" value="{!! $answer->id !!}"> {!! $answer->answer !!}
                                        </label> 
                                       </div>
                                     @endforeach
                                @else
                                    <small>Selecciona solo una.</small>
                                    @foreach($question->answers->shuffle() as $answer)
                                        <div class="radio">
                                            <label class="validate-question">
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
            <button type="submit" class="btn btn-lg btn-inverse btn-raised pull-right" ><span class="text-success">TERMINAR <i class="material-icons">arrow_right</i></span></button>
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
    <script type="text/javascript">
        function formcheck() {
            var fields = $(".validate-question")
                .find("input").serializeArray();

            $.each(fields, function(i, field) {
                if (!field.value)
                    alert(field.name + ' is required');
            });
            console.log(fields);
        }
    </script>
@endsection