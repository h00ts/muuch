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
                            <label for="name">Titulo</label>
                            <input type="text" name="name" class="form-control border-input input-lg" value="{!! $name !!}">
                        </div>
                        <div class="form-group form-horizontal">
                            <strong>Mostrar a </strong>
                            <div class="form-group">
                                @foreach($roles as $role)
                                    <div class="checkbox checkbox-inline">
                                    <input type="checkbox"> 
                                    <label>
                                        {{ $role->display_name }}
                                    </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                       <div class="form-group">
                          <table class="table table-responsive">
                              <tr>
                                  <th>Contenido</th>
                                  <th><a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newContentModal">Crear contenido</a> <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#contentModal">Asignar contenido</a></th>
                              </tr>
                              @foreach($page->contents as $content)
                                <tr>
                                    <td><a href="/config/contenido/{{ $content->id }}/edit">{{ $content->name }}</a></td>
                                    <td><a href="#" class="btn btn-danger btn-sm">Desasociar</a></td>
                                </tr>
                                @endforeach
                          </table>
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
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="contents">Descripción</label>
                                <textarea name="contents" id="contents" cols="30" rows="10" class="form-control">
                                    
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar </button>
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
            <form action="{!! route('contenido.store') !!}" method="POST">
            {!! csrf_field() !!}
            <input type="hidden" name="page_id">
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