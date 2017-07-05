@extends('layouts.app')
@section('content')
<div class="container">
	  <div class="row">
    <div class="col-lg-12">
      <a href="/" class="btn btn-default pull-right">
                        <i class="material-icons">arrow_left</i> Regresar
                    </a> 
      <h2><a href="/foro"><i class="material-icons">forum</i> Foro</a></h2>
      <hr>
    </div>
  </div>
	<div class="row">
		<div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="list-group">
                  <div class="list-group-item">
                    <div class="row-picture">
                      <img class="circle" src="/img/default_avatar.png" alt="icon">
                    </div>
                    <div class="row-content">
                      <h4 class="list-group-item-heading"><small>
                        @php($hola = collect(["¡Hola!", "Namaste", "Ní Haô!", "Shalom!", "Olá!", "Pribet!", "Konnichiwa",  "Hallo!", "Ciao!"]))
                        {!! $hola->random() !!}
                      </small><br>{!! $user->name !!}</h4>
                      <p class="list-group-item-text"><strong>Administrador</strong></p>
                      <p>{!! $user->email !!}</p>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <a href="/foro/create" class="btn btn-primary btn-raised btn-block"><i class="material-icons">chat</i> Nueva Discusión</a>
        <a href="#" class="btn btn-primary btn-raised btn-block"><i class="material-icons">chat</i> Nueva Pregunta</a>
    </div>
		<div class="col-md-8">
			<div class="panel panel-primary">
              <div class="panel-heading">
                <h2 class="panel-title"><a href="/foro" class="link"><i class="material-icons">question_answer</i> <strong>Foro de Discuciónes</strong> <i class="material-icons pull-right">arrow_right</i> </a></h2>
              </div>
              <div class="panel-body">
                <table class="table table-hover">
                    <tr>
                      <th>Discusión</th>
                      <th><i class="material-icons" style="font-size:18px" title="Vistas" data-toggle="tooltip" data-placement="left">remove_red_eye</i></th>
                      <th><i class="material-icons" style="font-size:18px" title="Respuestas" data-toggle="tooltip" data-placement="left">comment</i></th>
                      <th><i class="material-icons" style="font-size:18px" title="Respuesta más reciente" data-toggle="tooltip" data-placement="left">access_time</i></th>
                  </tr>
                  @foreach($threads as $thread)
                  <tr>
                    <td><a href="/foro/{{ $thread->id }}" style="font-size:16px; display:block"><strong>{!! $thread->title !!}</strong></a> <small><i class="material-icons" style="font-size:12px">account_circle</i> {{ $thread->user->name }}</small></td>
                    <td><span class="label">{{ ($thread->views) ? $thread->views : '0' }}</span></td>
                    <td><span class="label">{{ count($thread->replies) ? $thread->replies->count() : '0' }}</span></td>
                    <td>{{ count($thread->replies) ? $thread->replies->last()->user->name : '-' }}</td>
                  </tr>
                  @endforeach
                </table>
              </div>
            </div>
		</div>
	</div>
</div>
@endsection
