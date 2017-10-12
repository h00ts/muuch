@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
            {{ csrf_field() }}
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body text-center">
                        <h2 class="text-center">Evaluación - Modulo {{ '0'.$score->exam->module->module.': '.$score->exam->name }} </h2>
                        <p class="text-center lead">Contestaste:</p>
                            <p class="text-center lead text-success">{{ $score->score }} de {{ $possible }} correctas ({{ number_format(($score->score / $possible) * 100).'%' }})</p>
                            <p class="text-center lead text-danger">{{ $incorrect }} incorrectas</p>
                            <hr>
                    <div class="panel {{ ($score->passed) ? 'panel-success' : 'panel-danger' }}">
                        <div class="panel-heading">{{ ($score->passed) ? '¡Felicidades! Pasaste la evaluación' : 'Lo sentimos, no pasaste la evaluación' }}</div>
                        <div class="panel-body">
                            <h3 class="{{ ($score->passed) ? 'text-success' : 'text-danger' }}">{{ $grade }}</h3>
                            <p class="panel-text">de 100%</p>
                        </div>
                    </div>
                    <a href="/capacitacion" class="btn btn-primary btn-raised btn-block">Continuar...</a>
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