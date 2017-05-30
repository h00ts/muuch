@extends('layouts.config')

@section('content')
    <div class="container">
        <div class="row">
             <div class="col-lg-12">
                <h2>Nivel {!! $level !!}</h2>
                 <ul class="breadcrumb">
                  <li><a href="/config">Configuración</a></li>
                  <li><a href="/config/niveles">Capacitación</a></li>
                  <li class="active">Nivel {!! $level !!}</li>
                </ul>
                @include('admin.partials.alerts')
            </div>
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-body table-responsive">
                        <table class="table table-striped table">
                            <thead>
                                <tr>
                                    <th> </th>
                                    <th>Contenido</th>
                                    <th>Evaluaciónes</th>
                                </tr>
                            </thead>
                            @foreach($modules as $module)
                                <tr>
                                    <td>
                                    <p class="lead">Modulo {!! ($module->module > 9) ? $module->module : '0'.$module->module !!} <br>
                                        <small>{!! ($module->name != ' ') ? $module->name : 'Sin titulo' !!} <small>{!! $module->description !!}</small></small>
                                     <a class="btn btn-link btn-sm" href="#" 
                                       data-toggle="modal"
                                       data-id="{!! $module->id !!}"
                                       data-num="{!! ($module->module > 9) ? $module->module : '0'.$module->module !!}"
                                       data-title="{!! $module->name !!}"
                                       data-description="{!! $module->description !!}"
                                       data-target="#moduleModal"><i class="glyphicon glyphicon-pencil"></i></a>
                                        </p>
                                    </td>
                                    <td>
                                        @if(count($module->contents))
                                        <div class="list-group">
                                            @foreach($module->contents as $content)
                                                <a href="{!! route('contenido.edit', $content->id) !!}" class="list-group-item">{!! $content->name !!}</a>
                                            @endforeach
                                        </div>
                                        @endif
        
                                    </td>
                                    <td>
                                        @if(count($module->exams))
                                        <div class="list-group">
                                            @foreach($module->exams as $exam)
                                                <a href="{!! route('examen.edit', $exam->id) !!}" class="list-group-item">{!! $exam->name !!}</a>
                                            @endforeach
                                        </div>  
                                        @endif
                                     </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div id="box--confirm" class="panel-footer hidden">
                            Crear un nuevo modulo? <button id="button--confirm" class="btn btn-primary">Si, crear</button> <button id="button--dismiss" class="btn btn-default">Cancelar</button>
                        <div class="hidden" id="state--loading"><i class="glyphicon glyphicon-refresh glyphicon-spin"></i> Creando...</div>
                    </div>
                </div>
               
                <a href="#" class="btn btn-inverse btn-raised" id="button--show-box"><i class="glyphicon glyphicon-plus"></i> MODULO</a>
                 @if(count($modules))
                 <a href="{!! route('contenido.create') !!}" class="btn btn-inverse btn-raised"><i class="glyphicon glyphicon-plus"></i> Contenido</a>
                 <a href="{!! route('examen.create') !!}" class="btn btn-inverse btn-raised"><i class="glyphicon glyphicon-plus"></i> Examen</a>
                 @endif
                 <hr>
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
                $("#module-form").attr('action', '/config/modulos/'+ $(e.relatedTarget).data('id'));
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