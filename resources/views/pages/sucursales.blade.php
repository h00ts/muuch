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
        <div class="col-lg-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="map" style="width:100%;height:500px;"></div>
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
                    return "Somos " + total + " ILUCentros en total.";
                },
                language: {
                    search: "Filtrar: "
                },
                serverSide: true,
                processing: true,
                ordering: false,
                paging: false,
                pageLength: 11,
                ajax: '/datatables/sucursales',
                columns: [
                    {data: 'short_name', searchable: true},
                    {data: 'name'},
                    {data: 'direccion'},
                    {data: 'municipio'},
                    {data: 'estado'}
                ]
            });
        });
    </script>
    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 5,
                center: {lat: 19.3806279, lng: -99.17068319},
                scrollwheel: false,
            });
            var labels = 'ABCDEFGHIJKL';

            // Add some markers to the map.
            // Note: The code uses the JavaScript Array.prototype.map() method to
            // create an array of markers based on a given "locations" array.
            // The map() method here has nothing to do with the Google Maps API.
            var markers = locations.map(function(location, i) {
                return new google.maps.Marker({
                    position: location,
                    label: titles[i % titles.length]
                });
            });
            var markerCluster = new MarkerClusterer(map, markers,
                {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
        }
        var locations = [
            @foreach($sucursales as $sucursal)
            {!! '{'.$sucursal->coordinates."}," !!}
            @endforeach
        ];
        var titles = [
            @foreach($sucursales as $sucursal)
            "{!! $sucursal->short_name !!}",
            @endforeach
        ];
    </script>
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJAYRzEUoq_Ej0zurPfId1mw58Cu7I2FU&callback=initMap">
    </script>
@endsection

