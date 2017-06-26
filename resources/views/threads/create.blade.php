@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
	<div class="col-lg-12">
		<form action="{{ route('foro.store') }}" method="POST">
			{{ csrf_field() }}
			<div class="form-group">
				<label for="">Tema</label>
				<select name="category_id" id="category_id" class="form-control">
						<option value="0">Selecciona un tema</option>
						@foreach($cats as $cat)
							<option value="{{ $cat->id }}">{{ $cat->name }}</option>
						@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="">Titulo</label>
			<input type="text" class="form-control" name="title">
			</div>
			<label for="">Mensaje</label>
			<textarea name="body" id="" cols="30" rows="10" class="form-control"></textarea>
			<input type="submit" class="btn btn-block btn-success" value="PUBLICAR">
		</form>
	</div>
</div>
</div>
@endsection
