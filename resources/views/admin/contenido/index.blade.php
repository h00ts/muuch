@extends('layouts.config')
@section('title', 'Contenido')
@section('icon', 'accessibility')
@section('slug', 'contenido')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <a href="#" class="btn btn-primar" data-toggle="modal" data-target="#newContentModal"><i class="glyphicon glyphicon-plus"></i>Crear contenido</a>
                <hr>
                @include('admin.partials.alerts')
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Contenido</h4>
                    </div>
                    <div class="content">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th>Contenido</th>
                                <th></th>
                                <th>Modulo</th>
                                <th>Página</th>
                                <th>Categoria</th>
                            </tr>
                            </thead>
                            @foreach($contents as $content)
                                <tr>
                                    <td>
                                        <a href="/config/contenido/{{ $content->id }}/edit">{{ $content->name }}</a>
                                    </td>
                                    <td>
                                        @if(isset($content->file))
                                            <a href="{{  $content->file }}" target="_blank"><i class="material-icons">link</i></a>
                                        @endif
                                    </td>
                                    <td>{!! isset($content->module) ? '<a href="/config/niveles/'.$content->module->level.'/edit">'.$content->module->level.' - '.$content->module->module.'</a>' : '-' !!}</td>
                                    <td>{!! isset($content->page) ? '<a href="/config/muuch/'.$content->page->id.'/edit">'.$content->page->name.'</a>' : '-' !!}</td>
                                    <td>{!! isset($content->page->category) ? '<a href="/config/categoria/'.$content->page->category->id.'/edit">'.$content->page->category->name.'</a>' : '-' !!}</td>
                                </tr>
                            @endforeach
                        </table>
                        {{ $contents->links() }}
                    </div>
                </div>
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

        });
    </script>
@endsection