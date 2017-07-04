@extends('layouts.config')
@section('title', 'Usuarios')
@section('icon', 'group')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('admin.partials.alerts')
            </div>
            <div class="col-lg-12">
                            <button class="btn btn-primary" id="button--show-box"><i class="glyphicon glyphicon-plus"></i> Crear Usuario</button>
           <hr>
                <div class="card">
                    <div class="header">
                        <h4 class="title">Usuarios Activos</h4>
                    </div>
                    <div class="content">
                            <table class="table table-striped">
                                <thead>
                                <td>ID</td>
                                <td>Nombre</td>
                                <td>Correo</td>
                                <td>Rol</td>
                                <td>ILUCentro</td>
                                <td>Opciones</td>
                                <td></td>
                                </thead>
                                @foreach($users->where('active', 1) as $user)
                                    <tr>
                                        <td>{!! $user->id !!}</td>
                                        <td>{!! $user->name !!}</td>
                                        <td>{!! $user->email !!}</td>
                                        <td>{{ (count($user->roles)) ? $user->roles->first()->display_name : 'ERROR' }}</td>
                                        <td>{{ (count($user->ilucentro)) ? $user->ilucentro->short_name : '-' }}</td>
                                        <td><a href="/config/usuarios/{!! $user->id !!}/edit">Editar</a> | <a href="#">Desactivar</a></td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </table>
                    </div>
                </div>
             </div>

            @if(count($users->where('active', null)))
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Usuarios en Espera</h4>
                        </div>
                        <div class="content">
                            <table class="table table-striped">
                                <thead>
                                <td>ID</td>
                                <td>Nombre</td>
                                <td>Correo</td>
                                <td>ILUCentro</td>
                                <td>Asigna su rol</td>
                                </thead>
                                @foreach($users->where('active', null) as $user)
                                    <tr>
                                        <td>{!! $user->id !!}</td>
                                        <td>{!! $user->name !!}</td>
                                        <td>{!! $user->email !!}</td>
                                        <td>{{ (count($user->ilucentro)) ? $user->ilucentro->name : '-' }}</td>
                                        <td>
                                            <form action="{{ route('usuarios.update', $user->id) }}" method="POST" class="form-inline">
                                            <input type="hidden" name="_method" value="PATCH">
                                            {{ csrf_field() }}
                                            <select name="user_role" id="role" class="form-control" required="required">
                                                <option value="" disabled selected>---</option>
                                                @foreach($roles as $role)
                                                  <option value="{{ $role->id }}" required>{{ $role->display_name }}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="activate" value="TRUE">
                                              <button type="submit" class="btn btn-success">Activar</button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Roles</h3>
                    </div>
                    <div class="panel-body">
                        @foreach($roles as $role)
                        {{ $role->display_name }} <br>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Permisos</h3>
                    </div>
                    <div class="panel-body">
                        @foreach($permissions as $permission)
                        {{ $permission->display_name }} <br>
                        @endforeach
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection