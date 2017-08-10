@extends('layouts.app')
@section('content')
    @permission('page-'.$page->slug)
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <a href="{{ URL::previous() }}" class="btn btn-default pull-right">
                    <i class="material-icons">arrow_left</i> Regresar
                </a>
                <h3><i class="material-icons">store</i> {{ $name }}
                </h3>
                <hr>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-default display--page">
                    <div class="panel-body">
                        <table id="equipo" class="table table-responsive table-striped">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Telefono</th>
                                <th>ILUCentro</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endpermission
@endsection

@section('scripts')
    <script src="js/jquery.dataTables.min.js"></script>
    <script>
        $(function () {
            $('#equipo').DataTable({
                "infoCallback": function (settings, start, end, total) {
                    return "Somos una familia de " + total + " en total.";
                },
                language: {
                    search: "Filtrar: "
                },
                serverSide: true,
                processing: true,
                ordering: false,
                paging: false,
                pageLength: 5,
                ajax: '/datatables/equipo',
                columns: [
                    {data: 'name', orderable: true, searchable: true},
                    {data: 'email'},
                    {data: 'phone'},
                    {data: 'ilucentro.name'}
                ]
            });
        });
    </script>
@endsection

