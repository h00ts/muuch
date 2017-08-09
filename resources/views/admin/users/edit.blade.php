@extends('layouts.config')
@section('title', 'Editar usuario')
@section('icon', 'account_circle')
@section('slug', 'user_edit')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @include('admin.partials.alerts')
                <div class="panel panel-default">
                    <div class="panel-body">
                      @if($user->active)
                           <form action="{{ route('usuarios.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                               {!! csrf_field() !!}
                               <input type="hidden" name="_method" value="PUT">
                               <div class="row">
                                <div class="col-lg-3">
                                  <img src="{{ (count($user->getMedia('profile'))) ? $user->getMedia('profile')->first()->getUrl() : 'http://muuch.dev/img/default_avatar.png' }}" alt="avatar" class="img-responsive" style="max-height:200px;border-radius:200px" data-container="body" data-toggle="popover" data-placement="top" data-content="Cargar imagen..." id="img--upload">
                                    <input type="file" name="image" id="image--file" style="display: none;" accept="image/*">
                                </div>
                                 <div class="col-lg-9">
                                   <div class="form-group">
                                    <label for="name">Nombre</label>
                                   <input type="text" class="form-control border-input" name="name" value="{!! $user->name !!}">
                                  </div>
                                    <div class="form-group">
                                    <label for="email">Email</label>
                                   <input type="text" class="form-control border-input" name="email" value="{!! $user->email !!}">
                                     </div>
                                     <div class="form-group">
                                         <label for="ilucentro_id">ILUCENTRO</label>
                                         <select name="ilucentro_id" id="ilucentro" class="form-control border-input">
                                             @foreach($ilucentros as $ilucentro)
                                                 <option value="{{ $ilucentro->id }}"{{ ($ilucentro_id == $ilucentro->id) ? 'selected' : '' }}>{{ $ilucentro->name }}</option>
                                             @endforeach
                                         </select>
                                     </div>
                                 </div>
                               </div>
                               <div class="form-group row">
                                    <div class="col-md-6">
                                      <label for="role">Rol</label>
                                      <select name="role_id" id="role" class="form-control border-input" required="required">
                                          @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ ($role->id == $user->roles->first()->id) ? 'selected' : '' }}>{{ $role->display_name }}</option>
                                          @endforeach
                                      </select>
                                
                                    </div>
                                    <div class="col-md-6">
                                      <label for="posicion">Puesto</label>
                                 <input type="text" name="posicion" class="form-control border-input" value="{{ $posicion }}">
                                    </div>
                               </div>
                               <div class="form-group">
                                 <label for="">Descripcion del puesto</label>
                                 <input name="descripcion" type="text" class="form-control border-input" value="{{ $descripcion }}">
                               </div>
                               <div class="form-group row">
                                 <div class="col-md-6">
                                   <label for="phone">Telefono</label>
                                    <input name="phone" type="text" class="form-control border-input" value="{{ $phone }}">
                                 </div>
                                 <div class="col-md-6">
                                   <label for="extension">Extension</label>
                                    <input name="extension" type="text" class="form-control border-input" value="{{ $extension }}">
                                 </div>
                               </div>
                               <hr>
                               <button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-save"></i> Guardar usuario</button>
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