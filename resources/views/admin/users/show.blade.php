@extends('layouts.config')
@section('title', 'Pefil de usuario')
@section('icon', 'account_circle')
@section('slug', 'user_edit')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @include('admin.partials.alerts')
                <div class="panel panel-default">
                    <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <img src="{{ (count($user->getMedia('profile'))) ? $user->getMedia('profile')->first()->getUrl() : '/img/default_avatar.png' }}" alt="avatar" class="img-responsive" style="max-height:200px;border-radius:200px;margin:16px auto 0 auto;" data-container="body" data-toggle="popover" data-placement="top" data-content="Cargar imagen..." id="img--upload">
                                        <input type="file" name="image" id="image--file" style="display: none;" accept="image/*">
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group">
                                            <label for="name">Nombre</label>
                                            <input type="text" class="form-control border-input" name="name" value="{!! $user->name !!}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control border-input" name="email" value="{!! $user->email !!}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="ilucentro_id">ILUCENTRO</label>
                                            <select name="ilucentro_id" id="ilucentro" class="form-control border-input" disabled>
                                                    <option value="0">{{ $user->ilucentro->name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="role">Rol</label>
                                        <select name="role_user" id="role" class="form-control border-input" required="required" disabled>
                                                <option value="0">{{ $user->roles->first()->display_name }}</option>
                                        </select>

                                    </div>
                                    <div class="col-md-6">
                                        <label for="posicion">Puesto</label>
                                        <input type="text" name="posicion" class="form-control border-input" value="{{ $posicion }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Descripcion del puesto</label>
                                    <input name="descripcion" type="text" class="form-control border-input" value="{{ $descripcion }}" disabled>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="phone">Telefono</label>
                                        <input name="phone" type="text" class="form-control border-input" value="{{ $phone }}" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="extension">Extension</label>
                                        <input name="extension" type="text" class="form-control border-input" value="{{ $extension }}" disabled>
                                    </div>
                                </div>
                                <hr>
                        <a href="/config/usuarios/{!! $id !!}/edit" class="btn btn-success">Editar usuario</a>
                    </div>

                </div>
                <div class="card">
                    <div class="header">
                        <h4 class="title">Actividad</h4>
                    </div>
                    <div class="content">
                        <table id="actividad" class="table table-responsive table-striped">
                            <thead>
                            <tr>
                                <th>Actividad</th>
                                <th>Objeto</th>
                                <th>Fecha - Hora</th>
                            </tr>
                            </thead>

                            @foreach($activities as $activity)
                                <tr>
                                    <td>{!! $activity->description !!}</td>
                                    <td>{!! $activity->subject->name !!}</td>
                                    <td>{{ $activity->created_at->format('d M y - H:i') }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                {{--
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Actividad</h3>
                    </div>
                    <div class="panel-body">

                    </div>
                </div>
            </div>
            --}}

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