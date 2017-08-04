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
                    <table id="ilucentros" class="table table-responsive table-striped">
                        <thead>
                        <tr>
                            <th>Abv.</th>
                            <th>Ilucentro</th>
                            <th>Direccion</th>
                            <th>Municipio</th>
                            <th>Estado</th>
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
            $('#ilucentros').DataTable({
                "infoCallback": function (settings, start, end, total) {
                    return "Mostrando " + total + " Ilucentros";
                },
                language: {
                    search: "Buscar..."
                },
                serverSide: true,
                processing: true,
                ordering: true,
                paging: false,
                pageLength: 25,
                ajax: '/datatables/sucursales',
                columns: [
                    {data: 'short_name', orderable: true, searchable: true},
                    {data: 'name'},
                    {data: 'direccion'},
                    {data: 'municipio'},
                    {data: 'estado'}
                ]
            });
        });
    </script>
@endsection

