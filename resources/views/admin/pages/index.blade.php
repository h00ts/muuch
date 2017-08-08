@extends('layouts.config')
@section('title', 'Consulta')
@section('icon', 'accessibility')
@section('slug', 'consulta')
@section('content')
    <div class="container-fluid">
        <div class="row">
             <div class="col-lg-12">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#pageModal"><i class="glyphicon glyphicon-plus"></i> Página</a>
                <hr>
                @include('admin.partials.alerts')
            </div>
            <div class="col-md-12">
                <div class="card">
                     <div class="header">
                        <h4 class="title">Páginas</h4>
                    </div>
                    <div class="content">
                            <table class="table table-responsive text-default">
                                <tr>
                                    <th>Página</th>
                                    <th>Categoría</th>
                                    <th>Última modificación</th>
                                </tr>
                                @foreach($pages as $page)
                                <tr>
                                    <td><a href="{!! route('muuch.edit', $page->id) !!}">{!! $page->name !!}</a></td>
                                    <td><a href="{!! isset($page->category) ? route('categoria.edit', $page->category->id) : '#' !!}">{!! isset($page->category) ? $page->category->name : 'Ninguno' !!}</a></td>
                                    <td>{{ $page->updated_at->format('d M Y H:i') }}</td>
                                </tr>
                                @endforeach
                            </table>
                            {{ $pages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('modals')
<div class="modal fade" id="pageModal"
     tabindex="-1" role="dialog"
     aria-labelledby="pageModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" id="module-form">
            {!! csrf_field() !!}
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pagina <span id="module-num"></span></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Titulo</label>
                    <input type="text" name="name" id="module-name" class="form-control input-lg" required="required">
                </div>
                <div class="form-group">
                    <label for="description">Categoría</label>
                    <select name="category_id" id="categories" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ ($category->parent_id) ? $category->where('id', $category->parent_id)->first()->name.' > '.$category->name : $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-default"
                        data-dismiss="modal">Cancelar</button>
      <button type="submit" class="btn btn-primary">
        Crear
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