@extends('layouts.app')
@section('content')
    @permission('page-'.$page->slug)
    <div class="row">
        <div class="col-lg-12">
             <a href="{{ URL::previous() }}" class="btn btn-default pull-right">
                <i class="material-icons">arrow_left</i> Regresar
            </a> 
            <h3><a href="/consulta"><i class="material-icons">local_library</i> Bibilioteca</a> <i class="material-icons">chevron_right</i>
                {!! isset($page->category) ? '<a href="/categoria/'.$page->category->id.'">'.$page->category->name.'</a> <i class="material-icons">chevron_right</i>' : '' !!} {{ $name }}
            </h3>
            <hr>
        </div>
        <div class="col-lg-8 col-md-8">
            <div class="panel panel-default display--page">
                <div class="panel-body">
                    {!! ($markdown == "" && ! count($page->contents)) ? 'Todavía no hemos tenido la oportunidad de llenar este espacio. Puedes revisar el foro y abrir una nueva discución al respecto si lo crees necesario.' : '' !!}
                    @if($markdown === "['sucursales']")
                        SUKU
                    @elseif($markdown == "['directorio']")
                        @yield('directorio')
                    @elseif($markdown == "['personas']")
                        @yield('personas')
                    @else
                    {!! $markdown !!}
                    {!! count($page->contents) ? '<hr>' : '' !!}
                    <div class="list-group">
                    @foreach($page->contents as $content)
                        <div class="list-group-item">
                                @if($content->cover != '/img/content_default.png')
                                <div class="row-picture">
                                    <img src="{{ $content->cover }}" alt="icono" class="circle">
                                </div>
                                @else
                                <div class="row-action-primary">
                                    <i class="material-icons">insert_drive_file</i>
                                </div>
                                @endif
                            <div class="row-content">
                              <div class="action-secondary" data-container="body" data-toggle="popover" data-placement="left" data-content="Modificado el {{ $content->updated_at->format('d/m/Y') }} {{ ($content->module_id) ? '| Modulo '.$content->module->module : '' }}"><i class="material-icons">info</i></div>
                              <h4 class="list-group-item-heading"><a href="/contenido/ver/{{ $content->id }}" target="_blank" class="external_link">{{ $content->name }}</a></h4>
                              <p class="list-group-item-text">{{ $content->description }}</p>
                            </div>
                        </div>
                        <div class="list-group-separator"></div>
                    @endforeach
                    </div>
                @endif
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            @permission('edit-muuch')
                <a href="/config/muuch/{{ $id }}/edit" class="btn btn-default btn-block"><i class="material-icons">mode_edit</i> Editar pagina</a>
            @endpermission
            <div class="panel panel-primary">
                <div class="panel-heading">Consulta</div>
                <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked">
                        @foreach($categories->where('parent_id', null) as $category)
                            <li{!! ($category->id == $category_id || $category->parent_id == $category_id) ? ' class="active"' : '' !!}><a href="/categoria/{{ $category->id }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <form action="/buscar" method="GET">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="material-icons">search</i></div>
                        <input type="text" class="form-control input-lg" placeholder="Ingresa tu busqueda..." name="q">
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endpermission
@endsection

{{--
@section('scripts')
    <script type="text/javascript">
        $('.external_link').on('click', function(e) {
            e.preventDefault();
            var content = $(this).attr('href');
            $.ajax({
                method: post,
                url: content,
                data: {
                    href: content
                }
            });
        }).done(function(url) { // pass the url back to the client after you incremented it
            window.location = url;
        });
    </script>
@endsection
--}}