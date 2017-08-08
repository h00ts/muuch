@extends('layouts.config')
@section('title', 'Editar Categoria')
@section('icon', 'accessibility')
@section('slug', 'categorias')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <form action="{!! route('categoria.update', $id) !!}" method="POST">
                    {!! csrf_field() !!}
                     <input type="hidden" name="_method" value="PUT">
                    <div class="content">
                        <div class="form-group">
                            <label for="module">{!! isset($parent_id) ? 'SUBCATEGORÍA' : 'CATEGORÍA' !!}</label>
                        </div>
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" class="form-control border-input input-lg" value="{!! $name !!}" required>
                        </div>
                         <div class="form-group">
                            <label for="description">Descripcion</label>
                            <input type="text" name="description" class="form-control border-input input-lg" value="{!! $description !!}">
                        </div>
                        <div class="form-group">
                            <label for="parent">Padre</label>
                            <select name="parent_id" id="parent" class="form-control border-input input-lg">
                                <option value="">--</option>
                                @foreach($parents as $parent)
                                    <option value="{!! $parent->id !!}" {!! ($parent->id == $parent_id) ? 'selected' : '' !!}>{!! $parent->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                        @if(count($perm))
                        <div class="form-group">
                            <strong>Mostrar a </strong>
                            <div class="btn-group" data-toggle="buttons">
                                @foreach($roles->slice(1) as $role)
                                    <label class="btn btn-primary {{ ($role->hasPermission($perm->name)) ? 'active' : '' }}">
                                        <input type="checkbox" name="rol-{{ $role->name }}" autocomplete="off" value="{{ $role->id }}" {{ ($role->hasPermission($perm->name)) ? 'checked' : '' }}> {{ $role->display_name }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        <hr>
                        <button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar </button>

                        <button type="button" id="button--show-box" class="btn btn-danger pull-right btn-sm"><i class="material-icons">delete</i></button>
                        <div class="pull-right hidden" id="box--confirm"><button type="button" id="button--confirm" class="btn btn-danger"><i class="material-icons">warning</i> Si, borrar para siempre</button>
                        <button type="button" id="button--dismiss"><i class="material-icons">close</i> ¡No, esperate!</button>
                        </div>
                    </div>
                    </form>
                </div>
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
                            @foreach($category->pages as $page)
                                <tr>
                                    <td><a href="{!! route('muuch.edit', $page->id) !!}">{!! $page->name !!}</a></td>
                                    <td><a href="{!! isset($page->category) ? route('categoria.edit', $page->category->id) : '#' !!}">{!! isset($page->category) ? $page->category->name : 'Ninguno' !!}</a></td>
                                    <td>{{ $page->updated_at->format('d M Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
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
                $('#state--loading').removeClass('hidden');
                $.ajax({
                    url: "{!! route('categoria.destroy', $id) !!}",
                    type: "POST",
                    dataType: "JSON",
                    data: {'_method' : 'DELETE', 'id' : '{{ $id }}'},
                    success: function(result){
                        window.location.href = "{{ env('APP_URL').'/config/muuch' }}";
                    }
                });
            });
        });
    </script>
@endsection