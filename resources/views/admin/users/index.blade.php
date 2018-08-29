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
                <a class="btn btn-primary" href="/config/usuarios/create"><i class="glyphicon glyphicon-plus"></i> Crear Usuario</a>
           <hr>
                <div class="card">
                    <div class="header">
                        <h4 class="title">Usuarios Activos</h4>
                    </div>
                    <div class="content">
                            <table class="table table-striped">
                                <thead>
                                <td></td>
                                <td>Nombre</td>
                                <td>Correo</td>
                                <td>Rol</td>
                                <td>ILUCentro</td>
                                <td>Opciones</td>
                                <td></td>
                                </thead>
                                @foreach($users->sortBy('name') as $user)
                                    <tr>
                                        <td><i style="font-size:12px" class="material-icons {{ ($user->isOnline()) ? 'text-success' : 'text-muted' }}">fiber_manual_record</i></td>
                                        <td><a href="/config/usuarios/{!! $user->id !!}">{!! $user->name !!}</a></td>
                                        <td>{!! $user->email !!}</td>
                                        <td>{{ ($user->roles) ? $user->roles->first()->display_name : 'ERROR' }}</td>
                                        <td>{{ ($user->ilucentro) ? $user->ilucentro->short_name : '-' }}</td>
                                        <td><a href="/config/usuarios/{!! $user->id !!}/edit" class="btn btn-sm btn-info pull-left"><i class="material-icons">edit</i></a>
                                            <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST" class="pull-right"><input type="hidden" name="_method" value="DELETE"> {{ csrf_field() }} <button type="submit" class="btn btn-danger btn-sm pull-right"><i class="material-icons">delete</i></button> </form></td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </table>
                    </div>
                </div>
             </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Usuarios Inactivos</h4>
                        </div>
                        <div class="content">
                            <table class="table table-striped">
                                <thead>
                                <tr><td>Nombre</td>
                                <td>Correo</td>
                                <td>Rol</td>
                                <td>Ilucentro</td>
                                <td>Opciones</td></tr>
                                </thead>
                                @foreach($inactive->sortBy('name') as $user)
                                    <tr>
                                        <td><a href="/config/usuarios/{!! $user->id !!}">{!! $user->name !!}</a></td>
                                        <td>{!! $user->email !!}</td>
                                        <td>{{ ($user->roles) ? $user->roles->first()->display_name : 'ERROR' }}</td>
                                        <td>{{ ($user->ilucentro) ? $user->ilucentro->short_name : '-' }}</td>
                                        <td>
                                            <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST" class="pull-right form-inline"><input type="hidden" name="_method" value="DELETE"> {{ csrf_field() }} <button type="submit" class="btn btn-danger btn-sm pull-right"><i class="material-icons">delete</i></button> </form>
                                            @if($user->activation)
                                            <form action="/config/usuarios/{{ $user->id }}/reenviar" method="POST" class="pull-left form-inline">
                                                <input type="hidden" name="_method" value="PUT">
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-success btn-sm pull-right"><i class="material-icons">mail</i></button>
                                            </form>
                                                @endif
                                        </td>
                                    </tr>
                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Usuarios Desactivados</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th></th>
                                <th></th>
                            </thead>
                            @foreach($trashed->sortBy('name') as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <form action="/config/usuarios/restore" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                            <button type="submit" class="btn btn-success btn-sm"><i class="material-icons">thumb_up</i></button> Reactivar
                                        </form>
                                    </td>
                                    <td><button class="btn btn-danger btn-sm"><i class="material-icons">delete_forever</i></button> Eliminar para siempre</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>


            
        </div>
    </div>
@endsection