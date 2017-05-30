@extends('layouts.config')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb">
                  <li><a href="javascript:void(0)">Configuraión</a></li>
                  <li class="active">Categorías</li>
                </ul>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <form action="{!! route('categoria.update', $id) !!}" method="POST">
                    {!! csrf_field() !!}
                     <input type="hidden" name="_method" value="PUT">
                    <div class="content">
                        <div class="form-group">
                            <label for="module">{!! isset($parent_id) ? 'SUBCATEGORÍA' : 'CATEGORÍA' !!}</label>
                        </div>
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" class="form-control border-input input-lg" value="{!! $name !!}" required>
                        </div>
                         <div class="form-group">
                            <label for="description">Descripcion</label>
                            <input type="text" name="description" class="form-control border-input input-lg" value="{!! $description !!}">
                        </div>
                        <div class="form-group">
                            <label for="parent">Padre</label>
                            <select name="parent_id" id="parent" class="form-control border-input input-lg">
                                <option value="">--</option>
                                @foreach($parents as $parent)
                                    <option value="{!! $parent->id !!}" {!! ($parent->id == $parent_id) ? 'selected' : '' !!}>{!! $parent->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <strong>Mostrar a </strong>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default active">
                                    <input type="checkbox" autocomplete="off" checked> Ingenieros Comunitarios
                                </label>
                                <label class="btn btn-default">
                                    <input type="checkbox" autocomplete="off"> Coordinadores Regionales
                                </label>
                                <label class="btn btn-default">
                                    <input type="checkbox" autocomplete="off"> Administradores
                                </label>
                            </div>
                        </div>
                        <button class="btn btn-success btn-lg" type="submit"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar </button>

                        <button type="button" id="button--show-box" class="btn btn-danger pull-right"><i class="material-icons">delete</i></button>
                        <div class="pull-right hidden" id="box--confirm"><button type="button" id="button--confirm" class="btn btn-danger"><i class="material-icons">warning</i> Si, borrar para siempre</button>
                        <button type="button" id="button--dismiss"><i class="material-icons">close</i> ¡No, esperate!</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#button--show-box').on('click', function(){
                $('#button--show-box').hide();
                $('#box--confirm').removeClass('hidden');
            });

            $('#button--dismiss').on('click', function(){
                $('#button--show-box').show();
                $('#box--confirm').addClass('hidden');
            });

            $('#button--confirm').on('click', function(){
                $('#button--dismiss').attr('disabled', 'true');
                $('#button--confirm').attr('disabled', 'true');
                $('#state--loading').removeClass('hidden');
                $.ajax({
                    url: "{!! route('categoria.destroy', $id) !!}",
                    type: "POST",
                    dataType: "JSON",
                    data: {'_method' : 'DELETE', 'id' : '{{ $id }}'},
                    success: function(result){
                        window.location.href = "{{ env('APP_URL').'/config/muuch' }}";
                    }
                });
            });
        });
    </script>
@endsection