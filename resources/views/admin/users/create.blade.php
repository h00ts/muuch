@extends('layouts.config')
@section('title', 'Crear Nuevo Usuario')
@section('icon', 'account_circle')
@section('slug', 'user_new')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @include('admin.partials.alerts')
                <div class="panel panel-default">
                    <div class="panel-body">
                            <form action="{{ route('usuarios.store') }}" method="POST">
                                {!! csrf_field() !!}
                                <div class="row">
                                    <div class="col-lg-3">
                                        <img src="http://muuch.dev/img/default_avatar.png" alt="" class="img-responsive" class="border-radius:100%" data-container="body" data-toggle="popover" data-placement="top" data-content="Cargar imagen..." id="img--upload">
                                        <input type="file" name="image" id="image--file" style="display: none;">
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group">
                                            <label for="name">Nombre</label>
                                            <input type="text" class="form-control border-input" name="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control border-input" name="email">
                                        </div>
                                        <div class="form-group">
                                            <label for="ilucentro_id">ILUCENTRO</label>
                                            <select name="ilucentro_id" id="ilucentro" class="form-control border-input">
                                                @foreach($ilucentros as $ilucentro)
                                                    <option value="{{ $ilucentro->id }}">{{ $ilucentro->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="role">Rol</label>
                                        <select name="user_role" id="role" class="form-control border-input" required="required">
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="col-md-6">
                                        <label for="posicion">Puesto</label>
                                        <input type="text" name="posicion" class="form-control border-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Descripcion del puesto</label>
                                    <input name="descripcion" type="text" class="form-control border-input">
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="phone">Telefono</label>
                                        <input name="phone" type="text" class="form-control border-input">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="extension">Extension</label>
                                        <input name="extension" type="text" class="form-control border-input">
                                    </div>
                                </div>
                                <hr>
                                <button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-save"></i> Guardar usuario</button>
                            </form>

                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function(){
           $("#img--upload").on("click", function(){
                $("#image--file").click();
           });
        });

        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $("#img--upload").attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image--file").change(function(){
            readURL(this);
        });
    </script>

@endsection