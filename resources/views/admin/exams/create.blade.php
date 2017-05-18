@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center"><i class="glyphicon glyphicon-education"></i> Capacitación</h2>
            </div>
            <div class="col-lg-12">
                <h3><i class="glyphicon glyphicon-cog"></i> <a href="/admin">Administración</a> / Crear examen</h3>
            </div>
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <form action="{!! route('examen.store') !!}" method="POST">
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
                            <input type="text" name="name" class="form-control input-lg" placeholder="ej. B" required>
                        </div>
                        <div class="form-group">
                            <label for="file">Calificación minima de 100</label>
                            <input type="text" name="min_score" class="form-control input-lg" placeholder="ej. 65" required>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-primary" type="submit">Crear examen</button>
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