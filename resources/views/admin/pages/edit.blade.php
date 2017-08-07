@extends('layouts.config')
@section('title', 'Editar Página de MUUCH')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('admin.partials.alerts')
            </div>
            <div class="col-lg-12">

                <div class="panel panel-default">
                    <form action="{!! route('muuch.update', $id) !!}" method="POST">
                    {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="PUT">

                    <div class="panel-body">
                        <div class="form-group">
                            <label for="cat">Categoría</label>
                            <select name="category_id" id="cat" class="form-control border-input">
                                <option value="0">Ninguna</option>
                                @foreach($cat as $category)
                                    <option value="{{ $category->id }}" {{ ($category_id == $category->id) ? 'selected' : '' }}>{{ ($category->parent_id) ? $cat->where('id', $category->parent_id)->first()->name.' > '.$category->name : $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Titulo</label>
                            <input type="text" name="name" class="form-control border-input input-lg" value="{!! $name !!}">
                        </div>
                        <div class="row">
                            <div class="col-lg-12 form-group">
                                <label for="markdown">Markdown</label>
                                <textarea name="markdown" id="markdown" cols="30" rows="10" class="form-control border-input" required>{{ isset($markdown) ? $markdown : '' }}</textarea>
                            </div>
                        </div>
                       <div class="row">
                           <div class="col-md-12">
                               <div class="form-group">
                                   <table class="table table-responsive">
                                       <thead>
                                       <tr>
                                           <th><label>Contenido</label> | <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newContentModal">Crear contenido</a>
                                               <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#contentModal">Asignar contenido</a></th></th>
                                           <th>Descargable</th>
                                           <th>Modulo</th>
                                           <th></th>
                                       </tr>
                                       </thead>
                                       @foreach($page->contents as $content)
                                           <tr>
                                               <td><a href="/config/contenido/{{ $content->id }}/edit">{{ $content->name }}</a></td>
                                               <td>
                                                   @if(isset($content->file))
                                                   <a href="{{  $content->file }}">Ver Archivo</a>
                                                   @else
                                                   No
                                                   @endif
                                               </td>
                                               <td>{{ isset($content->module) ? 'N-'.$content->module->level.' M-'.$content->module->module.' :: '.$content->module->name : 'No' }}</td>
                                               <td><a href="#" class="btn btn-danger btn-sm pull-right">Desasociar</a></td>
                                           </tr>
                                       @endforeach
                                   </table>
                               </div>
                           </div>
                       </div>
                        <div class="row">
                            <div class="col-lg-6 form-group">
                            <label for="file">Icono</label>
                            <input type="text" name="file" class="form-control border-input input-sm" value="{!! $icon !!}">
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="cover">Caratula</label>
                            <input type="text" name="image" class="form-control border-input input-sm" value="{!! $image !!}">
                        </div>
                        </div>
                        @if(count($perm))
                        <div class="form-group form-horizontal">
                            <hr>
                            <strong>Mostrar a: </strong>
                            <div class="btn-group" data-toggle="buttons">
                                @foreach($roles->slice(1) as $role)
                                    <label class="btn btn-primary {{ ($role->hasPermission($perm->name)) ? 'active' : '' }}">
                                        <input type="checkbox" name="rol-{{ $role->name }}" autocomplete="off" value="{{ $role->id }}" {{ ($role->hasPermission($perm->name)) ? 'checked' : '' }}> {{ $role->display_name }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                            @endif

                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-success btn-lg" type="submit"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar página </button>
                        <a href="/muuch/{{ $id }}" class="btn btn-default pull-right">Visitar pagina</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modals')
<div class="modal fade" id="newContentModal"
     tabindex="-1" role="dialog"
     aria-labelledby="newContentModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{!! route('contenido.store') !!}" method="POST">
            {!! csrf_field() !!}
            <input type="hidden" name="page_id" value="{{ $id }}">
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Crear contenido</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Titulo</label>
                    <input type="text" name="name" id="content-name" class="form-control border-input input-lg" required="required">
                </div>
                <div class="form-group">
                    <label for="file">Archivo</label>
                    <input type="text" name="file" id="content-file" class="form-control border-input input-md" required="required">
                </div>
                <div class="form-group">
                    <label for="cover">Carátula</label>
                    <input type="text" name="cover" id="content-file" class="form-control border-input input-md" value="/img/content_default.png" required="required">
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

<div class="modal fade" id="contentModal"
     tabindex="-1" role="dialog"
     aria-labelledby="contentModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{!! route('contenido.update', null) !!}" method="POST" id="form-content-assign">
            {!! csrf_field() !!}
            <input type="hidden" name="page_id" value="{{ $id }}">
                <input type="hidden" name="_method" value="PUT">
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Asignar contenido</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Contenido</label>
                    <select name="id" id="content-assign" class="form-control border-input">
                        @foreach($all_contents as $content)
                            <option value="{{ $content->id }}">{{ $content->name }}</option>
                        @endforeach
                    </select>
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

            $( "#content-assign" ).change(function(e) {
                var val = '/config/contenido/' + $(this).val();
                $('#form-content-assign').attr('action', val);
            });

        });
    </script>
@endsection