@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
                <div class="col-md-12">
                     <a href="{{ URL::previous() }}" class="btn btn-default pull-right">
                        <i class="material-icons">arrow_left</i> Regresar
                    </a> 
                    <h3><a href="/muuch"><i class="material-icons">accessibility</i> MUUCH</a> <i class="material-icons">chevron_right</i> {{ $name }}</h3>
                    <hr>
                </div>
            <div class="col-lg-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">MUUCH</div>
                    <div class="panel-body">
                        <ul class="nav nav-pills nav-stacked">
                            @foreach($categories->where('parent_id', null) as $category)
                                @permission('category-'.$category->slug)
                                <li><a href="/muuch/cat/{{ $category->id }}">{{ $category->name }}</a></li>
                                @endpermission
                            @endforeach
                            </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                            @foreach($cat->pages as $page)
                                @permission('page-'.$page->slug)
                                    <a href="/muuch/{{ $page->id }}" class="btn btn-lg btn-block">{{ $page->name }}</a>
                                @endpermission
                            @endforeach
                            @foreach($categories->where('parent_id', $cat->id) as $category)
                                @permission('category-'.$category->slug)
                                    <a href="/muuch/cat/{{ $category->id }}" class="btn btn-lg btn-block">{{ $category->name }}</a>
                                @endpermission
                            @endforeach
                    </div>
                </div>
            </div>
    </div>
    </div>

@endsection