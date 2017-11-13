@extends('layouts.app')
@section('content')
<div class="container">
	  <div class="row">
    <div class="col-lg-12">
    	<a href="/foro" class="btn btn-default pull-right">
                        <i class="material-icons">arrow_left</i> Regresar
                    </a> 
      <h2><a href="/foro"><i class="material-icons">forum</i> Foro</a> <i class="material-icons">chevron_right</i> Nueva discución </h2>
      <hr>
    </div>
  </div>
	<div class="row">
		<div class="col-md-4">
            @include('layouts.profile')
    </div>
	<div class="col-md-8">
		<form action="{{ route('foro.store') }}" method="POST">
			{{ csrf_field() }}
			<div class="form-group">
				<label for="channel_id">Canal</label>
				<select name="channel_id" id="channel_id" class="form-control">
						<option value="0">Selecciona un canal</option>
						@foreach($channels as $channel)
							<option value="{{ $channel->id }}">{{ $channel->name }}</option>
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

@section('scripts')
	<script type="text/javascript">
        $(function(){
            $('input[type="submit"]').preventDoubleSubmission();
		});
	</script>
@endsection