@extends('layouts.config')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
             <div class="col-lg-12">
                @include('admin.partials.alerts')
            </div>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Categorías</h3>
                    </div>
                    <div class="panel-body table-responsive">
                        @foreach($categories->where('parent_id', 0) as $category)
                            {!! $category->name !!}
                            <hr>
                        @endforeach
                    </div>
                </div>
                <a href="#" class="btn btn-inverse"  data-toggle="modal" data-target="#categoryModal">
                    <i class="glyphicon glyphicon-plus"></i> Categoría
                </a>
                <hr>
                 <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Subcategorías</h3>
                    </div>
                    <div class="panel-body table-responsive">
                        @foreach($categories->where('parent_id', '>', 0) as $subcategory)
                            {!! $subcategory->name !!}
                            <hr>
                        @endforeach
                    </div>
                </div>
                <a href="#" class="btn btn-inverse"  data-toggle="modal" data-target="#subcategoryModal">
                    <i class="glyphicon glyphicon-plus"></i> Subcategoría
                </a>
            </div>
            <div class="col-md-8">
                <div class="panel panel-primary">
                     <div class="panel-heading">
                        <h3 class="panel-title">Páginas</h3>
                    </div>
                    <div class="panel-body table-responsive">
                            <table class="table table-responsive">
                                <tr>
                                    <th>Página</th>
                                    <th>Cateogoría</th>
                                </tr>
                                @foreach($pages as $page)
                                <tr>
                                    <td>{!! $page->name !!}</td>
                                    <td>{!! $page->category->name !!}</td>
                                </tr>
                                @endforeach
                            </table>
                    </div>
                </div>
                <a href="#" class="btn btn-default" data-toggle="modal" data-target="#pageModal"><i class="glyphicon glyphicon-plus"></i> Página</a>
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
                            <option value="{!! $category->id !!}">{!! $category->name !!}</option>
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


<div class="modal fade" id="categoryModal"
     tabindex="-1" role="dialog"
     aria-labelledby="categoryModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{!! route('category.store') !!}" id="module-form">
            {!! csrf_field() !!}
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Categoría <span id="module-num"></span></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" id="module-name" class="form-control input-lg" required="required">
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

<div class="modal fade" id="subcategoryModal"
     tabindex="-1" role="dialog"
     aria-labelledby="subcategoryModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{!! route('category.store') !!}" id="module-form">
            {!! csrf_field() !!}
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Subcategoría <span id="module-num"></span></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" id="module-name" class="form-control input-lg" required="required">
                </div>
                <div class="form-group">
                    <label for="description">Padre</label>
                    <select name="category_id" id="categories" class="form-control">
                        @foreach($categories as $category)
                            <option value="{!! $category->id !!}">{!! $category->name !!}</option>
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