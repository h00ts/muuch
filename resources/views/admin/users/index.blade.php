@extends('layouts.config')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @include('admin.partials.alerts')
                <h3><i class="material-icons">group</i> Usuarios</h3>
            </div>
            <div class="col-lg-12">
            
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Todos los Usuarios</h3>
                    </div>
                    <div class="panel-body">
                            <table class="table table-striped">
                                <thead>
                                <td>ID</td>
                                <td>Nombre</td>
                                <td>Correo</td>
                                <td>Rol</td>
                                <td>Opciones</td>
                                <td></td>
                                </thead>
                                @foreach($users->where('active', 1) as $user)
                                    <tr>
                                        <td>{!! $user->id !!}</td>
                                        <td>{!! $user->name !!}</td>
                                        <td>{!! $user->email !!}</td>
                                        <td>Administrador</td>
                                        <td><a href="/config/usuarios/{!! $user->id !!}/edit">Editar</a> | <a href="#">Desactivar</a></td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </table>
                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-primary" id="button--show-box"><i class="glyphicon glyphicon-plus"></i> NUEVO USUARIO</button>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Roles</h3>
                    </div>
                    <div class="panel-body"></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Permisos</h3>
                    </div>
                    <div class="panel-body"></div>
                </div>
            </div>

            @if(count($users->where('active', null)))
                <div class="col-md-12">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title">Nuevos Registros de Usuarios</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <thead>
                                <td>ID</td>
                                <td>Nombre</td>
                                <td>Correo</td>
                                <td>Rol</td>
                                <td>Opciones</td>
                                <td></td>
                                </thead>
                                @foreach($users->where('active', null) as $user)
                                    <tr>
                                        <td>{!! $user->id !!}</td>
                                        <td>{!! $user->name !!}</td>
                                        <td>{!! $user->email !!}</td>
                                        <td><select name="roles" id="roles">
                                            @foreach($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->display_name }}</option>
                                            @endforeach
                                        </select></td>
                                        <td>
                                            <form action="{{ route('usuarios.update', $user->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="PUT">
                                                <button class="btn btn-success btn-sm">Activar</button>
                                            </form>
                                        </td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            @endif
            
        </div>
    </div>
@endsection