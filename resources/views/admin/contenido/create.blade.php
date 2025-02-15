@extends('layouts.config')
@section('title', 'Contenido')
@section('icon', 'accessibility')
@section('slug', 'contenido')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3><i class="glyphicon glyphicon-cog"></i> Crear contenido</h3>
            </div>
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <form action="{!! route('contenido.store') !!}" method="POST">
                    {!! csrf_field() !!}
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="module">Modulo</label>
                            <select name="module_id" id="module_id" class="form-control input-lg">
                                @foreach($modules as $module)
                                    <option value="{!! $module->id !!}" {!! ($module_id == $module->id) ? 'selected' : '' !!}>Nivel {!! ($module->level > 9) ? $module->level : '0'.$module->level !!} - Modulo {!! ($module->module > 9) ? $module->module : '0'.$module->module !!} - {!! $module->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Titulo</label>
                            <input type="text" name="name" class="form-control input-lg">
                        </div>
                       <div class="form-group">
                           <label for="html">Markdown</label>
                           <textarea name="markdown"class="form-control" id="" cols="30" rows="10"></textarea>
                       </div>
                        <div class="form-group">
                            <label for="file">Descargable</label>
                            <input type="text" name="file" class="form-control input-lg" value=" ">
                        </div>
                        <div class="form-group">
                            <label for="cover">Caratula</label>
                            <input type="text" name="cover" class="form-control input-lg" value="/img/content_default.png" required>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-primary" type="submit">Crear contenido</button>
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