@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
            {{ csrf_field() }}
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body text-center">
                        <h1 class="text-center">Terminaste tu Evaluación</h1>
                        <p class="text-center lead">Estos son tus resultados:</p>
                        @foreach($scores as $score)
                            <h4 class="text-center"><strong>Modulo {{ $score->exam->module->module.': '.$score->exam->module->name }}</strong></h4>
                            <p class="text-center lead">{{ $score->score }} de {{ count($score->exam->answers->where('correct', 1)) }} ({{ ($score->score) ? number_format(($score->score / count($score->exam->answers->where('correct', 1)) * 100),0).'%' : '0%' }})</p>
                            <hr>
                        @endforeach
                        <h3 class="text-center">Calificación final:</h3>
                        <p class="text-center h1 strong {{ $total >= $avg ? 'text-success' : 'text-danger' }}">{{ $total }} de 100</p>
                        @if($total >= $avg)
                        <p class="lead text-center">¡Felicidades! Has subido al nivel {{ $user->level }}.</p>
                        <a href="/" class="btn btn-default btn-raised">Continuar...</a>
                        @else
                        <p class="lead text-center">Tu calificación no es suficiente para subir de nivel :/</p>
                        <a href="/" class="btn btn-default btn-raised">Continuar...</a>
                        @endif
                </div>
            </div>
        </div>
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