@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <form action="/examen/entrega" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="exam_id" value="{{ $exam->id }}">
            <div class="col-md-10 col-md-offset-1">
                <button type="submit" class="btn btn-lg btn-inverse btn-raised pull-right"><span class="text-success">TERMINAR <i class="material-icons">arrow_right</i></span></button>
                <div class="list-group">
                    <div class="list-group-item">
                        <div class="row-picture">
                            <img class="circle" src="{{ (count(Auth::user()->getMedia('profile'))) ? Auth::user()->getMedia('profile')->first()->getUrl() : '/img/default_avatar.png' }}" alt="icon">
                        </div>
                        <div class="row-content">
                            <h4>{!! Auth::user()->name !!}</h4>
                            <p class="list-group-item-text"><strong>Nivel {!! (Auth::user()->level) ? Auth::user()->level : '0' !!}</strong> | {{ Auth::user()->roles->first()->display_name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                @php($qn=1)
                @php($correct=0)
                <div class="panel-body">
                            <h2 class="text-center">Evaluación Nivel {!! $level !!}</h2>
                            <h4 class="text-center">Modulo {{ '0'.$exam->module->module }}</h4>
                            <h3 class="text-center">{{ $exam->name }}</h3>
                        <hr>
                            @foreach($exam->questions->shuffle() as $question)
                            <div class="form-group">
                                <h4 class="control-label" style="line-height:1.5"><span class="label label-primary">{{ $qn++ }}</span> {!! $question->question !!}</h4>
                                @if($question->answers->sum('correct') > 1)
                                    <small>Selecciona todas las que aplíquen.</small>
                                    @foreach($question->answers->shuffle()->take(5) as $answer)
                                     <div class="checkbox">
                                        <label class="validate-question">
                                            <input type="checkbox" name="a{!! $answer->id !!}" id="a{!! $answer->id !!}" value="{!! $answer->id !!}"> {!! $answer->answer !!}
                                        </label> 
                                       </div>
                                        @php(($answer->correct) ? $correct++ : '')
                                     @endforeach
                                @else
                                    <small>Selecciona solo una.</small>
                                    @foreach($question->answers->shuffle() as $answer)
                                        <div class="radio">
                                            <label class="validate-question">
                                                <input type="radio" name="a{!! $question->id !!}" value="{!! $answer->id !!}"> {!! $answer->answer !!}
                                            </label>
                                        </div>
                                        @php(($answer->correct) ? $correct++ : '')
                                         @endforeach
                                    @endif
                                    </div>
                        @endforeach    
                    </div>
            </div>
        </div>
        <div class="col-md-10 col-md-offset-1">
            <input type="hidden" name="correct" value="{{ $correct }}">
            <button type="submit" class="btn btn-lg btn-inverse btn-raised pull-right" ><span class="text-success">TERMINAR <i class="material-icons">arrow_right</i></span></button>
            <div class="list-group">
              <div class="list-group-item">
                <div class="row-picture">
                  <img class="circle" src="{{ (count(Auth::user()->getMedia('profile'))) ? Auth::user()->getMedia('profile')->first()->getUrl() : '/img/default_avatar.png' }}" alt="icon">
                </div>
                <div class="row-content">
                  <h4>{!! Auth::user()->name !!}</h4>
                  <p class="list-group-item-text"><strong>Nivel {!! (Auth::user()->level) ? Auth::user()->level : '0' !!}</strong> | {{ Auth::user()->roles->first()->display_name }}</p>
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
        $(function(){
            $('form').preventDoubleSubmission();
        });
    </script>
@endsection

@section('styles')
    <style type="text/css">
        .control-label img {
            max-height: 150px;
        }

        .radio img, .checkbox img {
            max-height: 50px;
        }
    </style>
@endsection