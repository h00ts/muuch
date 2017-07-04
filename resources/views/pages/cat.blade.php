@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
                <div class="col-md-12">
                     <a href="/muuch" class="btn btn-default pull-right">
                        <i class="material-icons">arrow_left</i> Regresar
                    </a> 
                    <h2><strong>MUUCH</strong> {{ $name }}</h2>
                </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if(!count($cat->pages))
                        <p><strong>OOPS!</strong> Todavia no hay nada aquí.</p>
                        @elseif($cat->parent_id)
                            @foreach($cat->pages as $page)
                            <a href="/muuch/{{ $page->id }}" class="btn btn-lg btn-block">{{ $page->name }}</a>
                            @endforeach
                        @else
                            @foreach($categories->where('parent_id', $cat->id) as $category)
                            <a href="/muuch/cat/{{ $category->id }}" class="btn btn-lg btn-block">{{ $category->name }}</a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
                    <div class="col-lg-4">
            <div class="panel panel-primary">
                <div class="panel-heading">MUUCH</div>
                <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked">
                        @foreach($categories->where('parent_id', null) as $category)
                            <li><a href="/muuch/cat/{{ $category->id }}">{{ $category->name }}</a></li>
                        @endforeach
                        </ul>
                </div>
            </div>
        </div>
    </div>

@endsection