@extends('layouts.app')
@section('content')
        <div class="row">
            <div class="col-lg-12">
                 <a href="{{ URL::previous() }}" class="btn btn-default pull-right">
                    <i class="material-icons">arrow_left</i> Regresar
                </a> 
                <h3><a href="/consulta"><i class="material-icons">accessibility</i> Consulta</a></h3>
            </div>
            <div class="col-lg-12">
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
            <div class="consulta">
            @foreach($categories->where('parent_id', null)->sortByDesc('order') as $category)
                @permission('category-'.$category->slug)
                    <div class="panel panel-default" style="display: inline-block; margin: 10px auto; width: 100%;">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4 bg-primary">
                                    <h4>{{ $category->name }}</h4>
                                </div>
                                <div class="col-md-8">
                                    @foreach($categories->where('parent_id', $category->id)->sortByDesc('order') as $subcategory)
                                        @permission('category-'.$subcategory->slug)
                                        <a href="/categoria/{{ $subcategory->id }}" class="btn btn-default btn-block" style="text-align:left"><i class="material-icons">folder_open</i> {{ $subcategory->name }}</a>
                                        @endpermission
                                    @endforeach
                                    @foreach($category->pages->sortByDesc('order') as $page)
                                        @permission('page-'.$page->slug)
        <a href="/consulta/{{ $page->id }}" class="btn btn-default btn-block" style="text-align:left"><i class="material-icons">chevron_right</i> {{ $page->name }}</a>
                                        @endpermission
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endpermission
            @endforeach
                <div class="panel panel-default" style="display: inline-block; margin: 10px auto; width: 100%; height:300px; background-image:url('https://s3-us-west-2.amazonaws.com/ilu-muuch/static/consulta.jpg'); background-size:cover; background-position: bottom center;">
                    <div class="panel-body">
                    </div>
                </div>
            </div>
@endsection
