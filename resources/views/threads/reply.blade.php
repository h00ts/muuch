@extends('layouts.app')
@section('content')
<div class="container">
	  <div class="row">
    <div class="col-lg-12">
      <a href="{{ URL::previous() }}" class="btn btn-default pull-right">
                        <i class="material-icons">arrow_left</i> Regresar
                    </a> 
      <h3><a href="/foro"><i class="material-icons">forum</i> Foro</a> <i class="material-icons">chevron_right</i> <a href="/foro/cat/{{ $thread->id }}">{{ $thread->category->name }}</a> <i class="material-icons">chevron_right</i> {{ $thread->title }} </h3>
      <hr>
    </div>
  </div>
	<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
        <div class="panel-heading">
          <h2 class="panel-title">{{ $thread->user->name }} <span class="label label-primary">({{ $thread->user->roles->first()->display_name }})</span> <small>Hace {{ \Carbon\Carbon::parse($thread->created_at)->diffForHumans(\Carbon\Carbon::now(), true) }}</small> </h2>
        </div>
        <div class="panel-body">
          <div class="col-sm-2">
              <img src="{{ (count($thread->user->getMedia('profile'))) ? $thread->user->getMedia('profile')->first()->getUrl() : '/img/default_avatar.png' }}" alt="avatar" class="img-responsive circle">
          </div>
          <div class="col-sm-10"><p>{{ $thread->body }}</p></div>
        </div>
      </div>
		<form action="{{ route('foro.store') }}" method="POST">
			{{ csrf_field() }}
			<div class="form-group">
				<label for="body">Respuesta</label>
			<textarea name="body" id="body" cols="30" rows="10" class="form-control"></textarea>
			</div>
			<input type="submit" class="btn btn-block btn-primary btn-raised" value="PUBLICAR">
		</form>
	</div>
</div>
</div>
@endsection
