@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                 <a href="{{ URL::previous() }}" class="btn btn-default pull-right">
                    <i class="material-icons">arrow_left</i> Regresar
                </a> 
                <h3><a href="/muuch"><i class="material-icons">accessibility</i> MUUCH</a></h3>
                
            </div>
            <div class="col-lg-12">
                <form action="/buscar" method="GET">
                    <div class="form-group">
                    <input type="text" class="form-control input-lg" placeholder="Ingresa tu busqueda..." name="q">
                </div>
                </form>
            </div>
        </div>
            <div style="column-count: 2; column-gap: 25px; ">
            @foreach($categories->where('parent_id', null) as $category)
                @permission('category-'.$category->slug)
                    <div class="panel panel-default" style="display: inline-block; margin: 10px auto; width: 100%;">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4 bg-primary">
                                    <h4>{{ $category->name }}</h4>
                                </div>
                                <div class="col-md-8">
                                    @foreach($categories->where('parent_id', $category->id) as $subcategory)
                                        @permission('category-'.$subcategory->slug)
                                        <a href="/muuch/cat/{{ $subcategory->id }}" class="btn btn-default btn-block" style="text-align:left"><i class="material-icons">folder_open</i> {{ $subcategory->name }}</a>
                                        @endpermission
                                    @endforeach
                                    @foreach($category->pages as $page)
                                        @permission('page-'.$page->slug)
                                        <a href="/muuch/{{ $page->id }}" class="btn btn-default btn-block" style="text-align:left"><i class="material-icons">chevron_right</i> {{ $page->name }}</a>
                                        @endpermission
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endpermission
            @endforeach
            </div>
        </div>
@endsection
