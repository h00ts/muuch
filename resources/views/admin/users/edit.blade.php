@extends('layouts.config')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @include('admin.partials.alerts')
                <ul class="breadcrumb">
                  <li><a href="/config">Configuración</a></li>
                  <li><a href="/config/usuarios">Usuarios</a></li>
                </ul>
            </div>
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                      @if($user->active)
                           <form action="{{ route('usuarios.update', $user->id) }}" method="POST">
                               {!! csrf_field() !!}
                               <input type="hidden" name="_method" value="PATCH">
                               <div class="form-group">
                                    <label for="name">Nombre</label>
                                   <input type="text" class="form-control" name="name" value="{!! $user->name !!}">
                               </div>
                               <div class="form-group">
                                    <label for="email">Email</label>
                                   <input type="text" class="form-control" name="email" value="{!! $user->email !!}">
                               </div>
                               <div class="form-group">
                                    <label for="role">Rol</label>
                                      <select name="user_role" id="role" class="form-control" required="required">
                                          @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ ($role->id == $user->roles->first()->id) ? 'selected' : '' }}>{{ $role->display_name }}</option>
                                          @endforeach
                                      </select>
                               </div>
                               <hr>
                               <button class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Guardar usuario</button>
                           </form>
                      @else
                          <form action="">
                               {!! csrf_field() !!}
                               <div class="form-group">
                                    <label for="name">Nombre</label>
                                   <input type="text" class="form-control" name="name" value="{!! $user->name !!}">
                               </div>
                               <div class="form-group">
                                    <label for="email">Email</label>
                                   <input type="text" class="form-control" name="email" value="{!! $user->email !!}">
                               </div>
                               <div class="form-group">
                                    <label for="role">Rol</label>
                                   <select name="role" id="role" class="form-control">
                                        <option value="ic">Ingeniero Comunitario</option>
                                        <option value="admin">Administrador</option>
                                   </select>
                               </div>
                               <button class="btn btn-success"><i class="glyphicon glyphicon-check"></i> ACTIVAR</button>
                           </form>
                      @endif
                    </div>
  
                </div>
            </div>

        </div>
    </div>
@endsection