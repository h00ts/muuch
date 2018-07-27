@extends('layouts.config')
@section('title', 'Capacitación')
@section('icon', 'school')
@section('slug', 'capacitacion')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('admin.partials.alerts')
            </div>
            <div class="col-lg-12">
                <button class="btn btn-primary" id="button--show-box"><i class="glyphicon glyphicon-plus"></i> Crear Nivel</button>
                        <div id="box--confirm" class="hidden">
                            Confirma crear un nuevo nivel: <button id="button--dismiss" class="btn btn-default"> No, regresar</button> | <button id="button--confirm" class="btn btn-primary" data-content="{!! $levels->max('level'); !!}">Si, crear</button>
                        </div>
                        <div class="hidden" id="state--loading"><i class="glyphicon glyphicon-refresh glyphicon-spin"></i> Creando...</div>
                        <hr>
                <div class="card">
                    <div class="content">
                        @if(count($levels))
                        <div class="row">
                            @foreach($levels as $level)
                                <div class="col-md-6 col-lg-4">
                                 <a href="{!! route('niveles.edit', $level->first()->level) !!}" class="h1 text-center" style="display:block; border:1px solid #ddd; margin:.4em .25em; padding:.7em; border-radius:6px;">
                                 Nivel {!! ($level->first()->level > 9) ? $level->first()->level : '0'.$level->first()->level !!}
                                 </a>
                                </div>
                            @endforeach
                        </div>
                        @else
                        No hay niveles.
                        @endif
                   </div></div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="content">
                        <table id="scores" class="table table-responsive table-striped">
                            <thead>
                                <tr>
                                    <td>Usuario</td>
                                    <td>Nivel</td>
                                    <td>Exámen</td>
                                    <td>Porcentaje (%)</td>
                                    <td>Fecha</td>
                                </tr>

                            </thead>
                            <tbody>
           
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
<script src="/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script>
    $(function () {


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
                        setTimeout(function(){
                            window.location.reload();
                        }, 200);
                    }
                });
            });


        $('#scores').DataTable({
            "infoCallback": function (settings, start, end, total) {
                return "Registros de capacitación:" + total;
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
                "zeroRecords":    "No existe resultado con ese criterio",
                "processing":     "Cargando...",
                "lengthMenu":     "Mostrar/Descargar _MENU_ resultados",
            },
            buttons: [
                {
                extend: 'csvHtml5',
                text: 'Descargar CSV',
                title: 'MUUCH-capacitacion'
                },
            ],
            dom: "<'row'<'col-sm-4'B><'col-sm-4'l><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-md-12'p>>",
            serverSide: true,
            processing: true,
            ordering: false,
            paging: true,
            pageLength: 25,
            ajax: '/datatables/scores',
            columns: [
                {data: 'user.name', "defaultContent": "Desactivado"},
                {data: 'level'},
                {data: 'exam.name'},
                {data: 'score', orderable: true, searchable: true},
                {data: 'created_at'}
            ]
        });

        $('#sync').preventDoubleSubmition();
    });
</script>
@endsection