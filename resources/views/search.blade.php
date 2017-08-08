@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                 <a href="{{ URL::previous() }}" class="btn btn-default pull-right">
                    <i class="material-icons">arrow_left</i> Regresar
                </a> 
                <h3><a href="/muuch"><i class="material-icons">accessibility</i> Consulta</a></h3>
                
            </div>
            <div class="col-lg-12">
                <form action="/buscar" method="GET">
                    <div class="form-group">
                    <input type="text" class="form-control input-lg" placeholder="Buscar..." name="q" value="{{ $query }}">
                </div>
                </form>
                <h5>Se encontraron {{ $count }} resultados relacionados a "{{ $query }}"</h5> <br>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="panel">
                    <div class="panel-heading"><h3 class="panel-title">Páginas</h3></div>
                    <div class="panel-body">
                    @if(count($pages))
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <td>Página</td>
                                <td>Categoría</td>
                            </tr>
                            </thead>
                            @foreach($pages as $page)
                               <tr>
                                   <td> <a href="/consulta/{{ $page->id }}"><i class="material-icons">chevron_right</i> {{ $page->name }}</a></td>
                                   <td>{{ isset($page->category) ? $page->category->name : '-' }}</td>
                               </tr>
                            @endforeach
                        </table>
                    @else
                        <h3>:(</h3>
                    @endif
                 </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="panel">
                    <div class="panel-heading"><h3 class="panel-title">Recursos</h3></div>
                    <div class="panel-body">
                @if(count($contents))
                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <td>Contenido</td>
                            <td>Página</td>
                        </tr>
                        </thead>
                    @foreach($contents as $content)
                            <tr>
                                <td> <a href="{{ isset($content->file) ? $content->file : '' }}" target="_blank"><i class="material-icons">insert_drive_file</i> {{ $content->name }}</a></td>
                                <td>{{ isset($content->page) ? $content->page->name : '-' }}</td>
                            </tr>
                    @endforeach
                    </table>
                @else
                <h3>:(</h3>
                @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <br><br>
                <img src="/img/search-by-algolia.png" alt="Algolia" style="width:150px">
            </div>
    </div>

@endsection