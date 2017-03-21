@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @include('admin.partials.alerts')
                <h3><i class="glyphicon glyphicon-cog"></i> <a href="/admin">Administración</a> / <a href="/admin/niveles">Niveles</a> / Nivel {!! $modules->first()->level !!}</h3>
            </div>
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <td>Modulo</td>
                            <td>Titulo</td>
                            <td>Contenido</td>
                            <td>Examenes</td>
                            </thead>
                            @foreach($modules as $module)
                                <tr>
                                    <td><p># {!! ($module->module > 9) ? $module->module : '0'.$module->module !!}</p></td>
                                    <td>{!! ($module->name != ' ') ? $module->name : 'Sin titulo' !!} <a href="#" data-toggle="modal"
                                                                                                       data-id="{!! $module->id !!}"
                                                                                                       data-num="{!! ($module->module > 9) ? $module->module : '0'.$module->module !!}"
                                                                                                       data-title="{!! $module->name !!}"
                                                                                                       data-description="{!! $module->description !!}"
                                                                                                       data-target="#moduleModal" class="pull-right"><i class="glyphicon glyphicon-pencil"></i></a> </td>
                                    <td>
                                        @if(count($module->contents))
                                            @foreach($module->contents as $content)
                                                <a href="{!! route('contenido.edit', $content->id) !!}">{!! $content->name !!}</a>{!! (count($module->contents) > 1 && $module->contents->last()->id != $content->id) ? ', ' : '' !!}
                                            @endforeach
                                        @else
                                            No hay contenido
                                        @endif
                                        <a href="{!! route('contenido.create').'/'.$module->id !!}" class="pull-right"><i class="glyphicon glyphicon-plus"></i></a>
                                    </td>
                                    <td>{!! count($module->exams) ? $module->exams : 'No hay examenes' !!} <a href="#" class="pull-right"><i class="glyphicon glyphicon-plus"></i></a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="panel-footer">
                        <a href="#" class="btn btn-link" id="button--show-box"><i class="glyphicon glyphicon-plus"></i> NUEVO MODULO</a>
                        <div id="box--confirm" class="hidden">
                            Confirma crear un nuevo modulo: <button id="button--dismiss" class="btn btn-default">No, regresar</button> | <button id="button--confirm" class="btn btn-primary">Si, crear</button>
                        </div>
                        <div class="hidden" id="state--loading"><i class="glyphicon glyphicon-refresh glyphicon-spin"></i> Creando...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modals')
    <div class="modal fade" id="moduleModal"
         tabindex="-1" role="dialog"
         aria-labelledby="moduleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" id="module-form">
                {!! csrf_field() !!}
                <input type="hidden" name="_method" value="PUT">
                <div class="modal-header">
                    <button type="button" class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Modulo <span id="module-num"></span> | Nivel {!! $modules->first()->level !!}</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Titulo</label>
                        <input type="text" name="name" id="module-name" class="form-control input-lg" required="required">
                    </div>
                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <textarea name="description" id="module-description" class="form-control" required="required"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-default"
                            data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">
            Guardar
          </button>
                </div>
                </form>
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


            $('#moduleModal').on("show.bs.modal", function (e) {
                $("#module-num").html($(e.relatedTarget).data('num'));
                $("#module-id").val($(e.relatedTarget).data('id'));
                $("#module-name").val($(e.relatedTarget).data('title'));
                $("#module-description").val($(e.relatedTarget).data('description'));
                $("#module-form").attr('action', '/admin/modulos/'+ $(e.relatedTarget).data('id'));
            });

            /* New module */
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
                    url: '{!! route('modulos.store') !!}',
                    type: "POST",
                    dataType: 'JSON',
                    data: {
                        'level': '{!! $level !!}',
                    },
                    success: function(result){
                        setTimeout(function(){
                            window.location.reload();
                        }, 200);
                    }
                });
            });
        });
    </script>
@endsection