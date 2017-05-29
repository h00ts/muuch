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
                    <form action="{!! route('category.update', $category->id) !!}" method="POST">
                    {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="PUT">
                    <div class="content">
                        <div class="form-group">
                            <label for="module">CATEGORÍA</label>
                        </div>
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" class="form-control input-lg" value="{!! $category->name !!}">
                        </div>
                         <div class="form-group">
                            <label for="name">Descripcion</label>
                            <input type="text" name="description" class="form-control input-lg" value="{!! isset($category->description) ? $category->description : '' !!}">
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
                        <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar </button>
                        <a href="#" class="btn btn-link"><i class="glyphicon glyphicon-eye-open"></i> Vista previa</a>
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
                $('#box--confirm').hide();
                $('#state--loading').removeClass('hidden');
                $.ajax({
                    url: '{!! route('niveles.store') !!}',
                    type:"POST",
                    dataType: 'JSON',
                    success: function(result){
                        $("#div1").html(result);
                    }
                });
            });
        });
    </script>
@endsection