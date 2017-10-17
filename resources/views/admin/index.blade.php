@extends('layouts.config')
@section('title', 'Configuración')
@section('icon', 'settings')
@section('slug', 'configuracion')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Material de Capacitación</h4>
                    </div>
                    <div class="content">
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th>
                                    Contenido
                                </th>
                                <th>
                                    Completado
                                </th>
                            </tr>
                            </thead>
                        @foreach($top_contents as $content)
                            <tr>
                                <td><a href="/config/contenido/{{ $content->id }}/edit">{{ $content->name }}</a></td>
                                <td>{{ $content->users->count().' veces' }}</td>
                            </tr>
                        @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Ultimos Exámenes</h4>
                    </div>
                    <div class="content">
                            <table class="table table-sm">
                                <thead>
                                <tr>
                                    <th>
                                        Usuario
                                    </th>
                                    <th>
                                        Puntaje
                                    </th>
                                </tr>
                                </thead>
                                @foreach($recent_scores as $score)
                                    <tr>
                                        <td><a href="/config/usuarios/{{ $score->user->id }}">{{ $score->user->name }}</a></td>
                                        <td>{{ $score->percent.'%' }}</td>
                                    </tr>
                                @endforeach
                            </table>
                    </div>
                </div>
            </div>
        </div>
        {{--
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Últimas Páginas</h4>
                    </div>
                    <div class="content">
                        <table class="table table-responsive text-default">
                            <tr>
                                <th>Página</th>
                                <th>Categoría</th>
                            </tr>
                            @foreach($pages as $page)
                                <tr class="small">
                                    <td> <strong><a href="{!! route('muuch.edit', $page->id) !!}"><i class="material-icons" style="font-size: 16px;">chevron_right</i> {!! $page->name !!}</a></strong></td>
                                    <td><a href="{!! isset($page->category) ? route('categoria.edit', $page->category->id) : '#' !!}">{!! isset($page->category) ? $page->category->name : '-' !!}</a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Últimos Documentos</h4>
                    </div>
                    <div class="content">
                        <table class="table table-responsive">
                            <tr>
                                <th>Contenido</th>
                                <th></th>
                                <th>Modulo</th>
                                <th>Página</th>
                                <th>Categoria</th>
                            </tr>

                            @foreach($contents as $content)
                                <tr class="small">
                                    <td>
                                        <strong><a href="/config/contenido/{{ $content->id }}/edit"><i class="material-icons" style="font-size:18px">description</i> {{ $content->name }}</a></strong>
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

                    </div>
                </div>
                --}}
            </div>

                 <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Actividad de Usuarios</h4>
                        </div>
                        <div class="content">
                                <table id="actividad" class="table table-responsive table-striped">
                                        <thead>
                                        <tr>
                                            <th>Actividad</th>
                                            <th>Objeto</th>
                                            <th>Usuario</th>
                                            <th>Fecha - Hora</th>
                                        </tr>
                                        </thead>
                                    {{--
                                    @foreach($activities as $activity)
                                        <tr>
                                            <td>{!! $activity->causer->email !!}</td>
                                            <td>{!! $activity->subject->name !!}</td>
                                            <td>{!! $activity->description !!}</td>
                                            <td>{{ $activity->created_at->format('d M y - H:i') }}</td>
                                        </tr>
                                    @endforeach
                                    --}}
                                </table>

                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
	$( document ).ready(function() {
    $('#select').selectize({
        delimiter: ',',
        persist: false,
        valueField: 'tag',
        labelField: 'tag',
        searchField: 'tag',
        options: tags,
        create: function(input) {
            return {
                tag: input
            }
        }
    });
});
</script>
<script src="js/jquery.dataTables.min.js"></script>
<script>
    $(function () {
        $('#actividad').DataTable({
            "infoCallback": function (settings, start, end, total) {
                return "Registros de actividad:" + total;
            },
            language: {
                search: "Filtrar: ",
                show: "Mostrar ",
                "paginate": {
                    "first":      "Primero",
                    "last":       "Último",
                    "next":       "Siguiente",
                    "previous":   "Anterior"
                },
                "zeroRecords":    "No existe actividad con ese criterio",
                "processing":     "Cargando...",
                "lengthMenu":     "Mostrar _MENU_",
            },
            dom: "<'row'<'col-sm-6'f><'col-sm-6'>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'p><'col-sm-7'l>>",
            serverSide: true,
            processing: true,
            ordering: false,
            paging: true,
            pageLength: 25,
            ajax: '/datatables/activity',
            columns: [
                {data: 'description', orderable: true, searchable: true},
                {data: 'subject.name', "defaultContent": "No disponible"},
                {data: 'causer.email', "defaultContent": "Desactivado"},
                {data: 'created_at'}
            ]
        });
    });
</script>
@endsection
