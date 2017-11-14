@extends('layouts.config')
@section('title', 'Editor de Contenido')
@section('icon', 'accessibility')
@section('slug', 'contenido')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @include('admin.partials.alerts')
            </div>
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <form action="{!! route('contenido.update', $id) !!}" method="POST">
                    {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="PUT">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="page">Página</label>
                                    <select name="page_id" id="page" class="form-control border-input">
                                        <option value="">---</option>
                                        @foreach($pages as $page)  
                                            <option value="{{ $page->id }}" {{ (isset($content->page) && $content->page->id == $page->id) ? 'selected' : '' }}>{{ $page->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="page">Modulo</label>
                                    <select name="module_id" id="module" class="form-control border-input">
                                        <option value="">---</option>
                                        @foreach($modules as $module)
                                            <option value="{{ $module->id }}" {{ (isset($content->module) && $content->module->id == $module->id) ? 'selected' : '' }}>N-{{ $module->level }} M-{{ $module->module }} :: {{ $module->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Titulo</label>
                            <input type="text" name="name" class="form-control border-input input-lg" value="{!! $name !!}">
                        </div>
                       
                       <div class="row">
                           <div class="col-md-6">
                               <div class="form-group">
                                   <label for="description">Descripción</label>
                                   <textarea name="description" class="form-control border-input" id="description" cols="30" rows="10">{!! $description !!}</textarea>
                               </div>
                           </div>
                           <div class="col-md-6">
                               <div class="form-group">
                                   <label for="markdown">Markdown</label>
                                   <textarea name="markdown" class="form-control border-input" id="markdown" cols="30" rows="10">{!! $markdown !!}</textarea>
                               </div>
                           </div>
                       </div>
                        <div class="form-group">
                            <label for="file">Descargable</label>
                            <input type="text" name="file" class="form-control border-input input-lg" value="{!! $file !!}">
                        </div>
                        <div class="form-group">
                            <label for="cover">Caratula</label>
                            <input type="text" name="cover" class="form-control border-input input-lg" value="{!! $cover !!}">
                        </div>

                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar </button>
                        <button type="button" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger" onclick="set_delete_modal({!! $content->id !!})"><i class="material-icons">delete_forever</i></button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modals')
<div class="modal fade" id="deleteModal"
     tabindex="-1" role="dialog"
     aria-labelledby="deleteModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{!! route('contenido.destroy', 0) !!}" method="POST" id="delete_content">
            {!! csrf_field() !!}
            <input type="hidden" name="_method" value="DELETE">
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Eliminar contenido</h4>
            </div>
            <div class="modal-body">
                <p class="lead">Estas seguro?</p>
            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-default"
                        data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-danger">
                    ELIMINAR
                  </button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
        function set_delete_modal(id) {
            $("#delete_content").attr("action", "/config/contenido/"+id);
        }
</script>
@endsection