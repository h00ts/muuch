@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
                <div class="col-md-12">
                     <a href="/" class="btn btn-default pull-right">
                        <i class="material-icons">arrow_left</i> Regresar
                    </a> 
                    <h2><a href="/muuch"><i class="material-icons">accessibility</i> MUUCH</a></h2>
                    <hr>
                </div>

            @foreach($categories->where('parent_id', null) as $category)
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4 bg-primary">
                                <h4>{{ $category->name }}</h4>
                            </div>
                            <div class="col-md-8">
                                @foreach($categories->where('parent_id', $category->id) as $subcategory)
                                    <a href="/muuch/cat/{{ $subcategory->id }}" class="btn btn-default btn-block">{{ $subcategory->name }}</a>
                                @endforeach
                                @foreach($category->pages as $page)
                                    <a href="/muuch/{{ $page->id }}" class="btn btn-default btn-block">{{ $page->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
    </div>

@endsection