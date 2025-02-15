@extends('layouts.guest')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2 class="text-center">¡Bienvenid@ al MUUCH!</h2>
            <div class="panel panel-primary">
                <div class="panel-heading">Registrate</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/registro') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre Completo</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Correo de Iluméxico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="ejemplo@ilumexico.mx" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="ilucentro" class="col-md-4 control-label">ILUCentro</label>

                            <div class="col-md-6">
                                <select name="ilucentro_id" id="ilucentro" class="form-control">
                                    <option value="" disabled selected>Seleccióna tu ILUCentro</option>
                                    @foreach($ilucentros as $ilucentro)
                                    <option value="{{ $ilucentro->id }}">{{ $ilucentro->name.' ('.$ilucentro->short_name.')' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirma la Contraseña</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary btn-block btn-raised btn-lg">
                                    Registrarme
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
         <div class="col-lg-12 text-center">
            <h2><i class="material-icons">accessibility</i></h2>
            <h4>La palabra MUUCH proviene del maya y significa "juntos". </h4>
            <p>
Esta plataforma fué creada con la intención de acercarnos y ayudarnos a construir un mejor ILUMÉXICO JUNTOS.<br> Te invitamos a explorar la plataforma, así como a enviarnos todos tus comentarios para enriquecerla.</p>
        </div>
    </div>
</div>
@endsection
