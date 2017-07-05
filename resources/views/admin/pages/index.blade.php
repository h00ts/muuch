@extends('layouts.config')
@section('title', 'Muuch')
@section('icon', 'accessibility')
@section('content')
    <div class="container-fluid">
        <div class="row">
             <div class="col-lg-12">
                <a href="#" class="btn btn-primary"  data-toggle="modal" data-target="#categoryModal">
                    <i class="glyphicon glyphicon-plus"></i> Categoría
                </a>
                <a href="#" class="btn btn-primary"  data-toggle="modal" data-target="#subcategoryModal">
                    <i class="glyphicon glyphicon-plus"></i> Subcategoría
                </a>
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#pageModal"><i class="glyphicon glyphicon-plus"></i> Página</a>
                <hr>
                @include('admin.partials.alerts')
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Categorías</h4>
                    </div>
                    <div class="content table-responsive">
                        @foreach($categories->where('parent_id', 0) as $category)
                            <h5><a href="/config/categoria/{!! $category->id !!}/edit">{!! $category->name !!}</a></h5>
                            <ul>
                                @foreach($categories->where('parent_id', $category->id) as $subcategory)
                                    <li><a href="/config/categoria/{!! $subcategory->id !!}/edit" class="">{!! $subcategory->name !!}</a></li>
                                @endforeach
                            </ul>
                            <hr>
                        @endforeach
                    </div>
                </div>
                
            </div>
            <div class="col-md-8">
                <div class="card">
                     <div class="header">
                        <h4 class="title">Páginas</h4>
                    </div>
                    <div class="content">
                            <table class="table table-responsive">
                                <tr>
                                    <th>Página</th>
                                    <th>Categoría</th>
                                </tr>
                                @foreach($pages as $page)
                                <tr>
                                    <td><a href="{!! route('muuch.edit', $page->id) !!}">{!! $page->name !!}</a></td>
                                    <td><a href="{!! route('categoria.edit', $page->category->id) !!}">{!! $page->category->name !!}</a></td>
                                </tr>
                                @endforeach
                            </table>
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


<div class="modal fade" id="categoryModal"
     tabindex="-1" role="dialog"
     aria-labelledby="categoryModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{!! route('categoria.store') !!}" id="module-form">
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
            <form method="POST" action="{!! route('categoria.store') !!}" id="module-form">
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
                    <select name="parent_id" id="categories" class="form-control">
                        @foreach($categories->where('parent_id', 0) as $category)
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