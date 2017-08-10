@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
                <div class="col-md-12">
                     <a href="{{ URL::previous() }}" class="btn btn-default pull-right">
                        <i class="material-icons">arrow_left</i> Regresar
                    </a> 
                    <h3><a href="/consulta"><i class="material-icons">accessibility</i> Consulta</a> <i class="material-icons">chevron_right</i>
                        {!! isset($parent_id) ? '<a href="/categoria/'.$categories->where('id', $parent_id)->first()->id.'">'.$categories->where('id', $parent_id)->first()->name.'</a> <i class="material-icons">chevron_right</i>' : '' !!}
                        {{ $name }}</h3>
                    <hr>
                </div>
            <div class="col-lg-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">Consulta</div>
                    <div class="panel-body">
                        <ul class="nav nav-pills nav-stacked">
                            @foreach($categories->where('parent_id', null) as $category)
                                @permission('category-'.$category->slug)
                                <li{!! ($category->id == $id || $category->id == $parent_id) ? ' class="active"' : '' !!}><a href="/categoria/{{ $category->id }}">{{ $category->name }}</a></li>
                                @endpermission
                            @endforeach
                            </ul>
                    </div>
                </div>
                <div class="panel panel-default">
                    <img src="https://s3-us-west-2.amazonaws.com/ilu-muuch/static/sidebar1.jpg" alt="Consulta" class="img-responsive">
                </div>
                
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                            @foreach($cat->pages as $page)
                                @permission('page-'.$page->slug)
                                    <a href="/consulta/{{ $page->id }}" class="btn btn-lg btn-block" style="text-align:left"><i class="material-icons">chevron_right</i> {{ $page->name }}</a>
                                @endpermission
                            @endforeach
                            @foreach($categories->where('parent_id', $cat->id) as $category)
                                @permission('category-'.$category->slug)
                                    <a href="/categoria/{{ $category->id }}" class="btn btn-lg btn-block" style="text-align:left"><i class="material-icons">folder_open</i> {{ $category->name }}</a>
                                @endpermission
                            @endforeach
                    </div>
                </div>
            </div>
    </div>
    </div>

@endsection