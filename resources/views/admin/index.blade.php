@extends('layouts.config')
@section('title', 'Configuración')
@section('icon', 'settings')
@section('slug', 'configuracion')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <!--
        	<div class="col-md-6">
				<select name="select" id="select">
					<option value="d">Dood</option>
					<option value="w">whats this</option>
				</select>
        	</div> -->
                 <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Usuarios en Espera</h4>
                        </div>
                        <div class="content">
                            <table class="table table-striped">
                                <thead>
                                <tr><td>ID</td>
                                <td>Nombre</td>
                                <td>Correo</td>
                                <td>ILUCentro</td>
                                <td>Rol del usuario</td>
                            </tr>
                                </thead>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{!! $user->id !!}</td>
                                        <td>{!! $user->name !!}</td>
                                        <td>{!! $user->email !!}</td>
                                        <td>{{ (count($user->ilucentro)) ? $user->ilucentro->name : '-' }}</td>
                                        
                                            <form action="{{ route('usuarios.update', $user->id) }}" method="POST" class="form-inline">
                                            	<td>
                                            <input type="hidden" name="_method" value="PATCH">
                                            {{ csrf_field() }}
                                            <select name="user_role" id="role" class="form-control" required="required">
                                                <option value="" disabled selected>Selecciona uno:</option>
                                                @foreach($roles as $role)
                                                  <option value="{{ $role->id }}" required>{{ $role->display_name }}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="activate" value="TRUE">
                                              </td
                                              </form>
                                              <td><button type="submit" class="btn btn-success btn-block">Activar</button></td>
                                            </form>
                                        <td><button class="btn btn-danger">Borrar</button></td>

                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                	<div class="card">
                        <div class="header">
                            <h4 class="title">Paginas Recientes</h4>
                        </div>
                        <div class="content">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                	<div class="card">
                        <div class="header">
                            <h4 class="title">Contenido Recientes</h4>
                        </div>
                        <div class="content">
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
	$( document ).ready(function() {
    $('#select').selectize({
        delimiter: ',',
        persist: false,
        valueField: 'tag',
        labelField: 'tag',
        searchField: 'tag',
        options: tags,
        create: function(input) {
            return {
                tag: input
            }
        }
    });
});
</script>
@endsection
