@extends('layouts.app')
@section('content')
<div class="container">
	  <div class="row">
    <div class="col-lg-12">
      <h2><a href="/foro"><i class="material-icons">forum</i> Foro</a> <i class="material-icons">chevron_right</i> Nueva discución </h2>
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
    </div>
	<div class="col-md-8">
		<form action="{{ route('foro.store') }}" method="POST">
			{{ csrf_field() }}
			<div class="form-group">
				<label for="category_id">Tema</label>
				<select name="category_id" id="category_id" class="form-control">
						<option value="0">Selecciona un tema</option>
						@foreach($cats as $cat)
							<option value="{{ $cat->id }}">{{ $cat->name }}</option>
						@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="title">Titulo</label>
			<input type="text" class="form-control" name="title" id="title">
			</div>
			<div class="form-group">
				<label for="body">Mensaje</label>
			<textarea name="body" id="body" cols="30" rows="10" class="form-control"></textarea>
			</div>
			<input type="submit" class="btn btn-block btn-raised btn-primary" value="PUBLICAR">
		</form>
	</div>
</div>
</div>
@endsection
