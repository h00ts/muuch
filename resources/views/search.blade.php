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
                    <input type="text" class="form-control input-lg" placeholder="Buscar..." name="q">
                </div>
                </form>
            </div>
            <div class="col-lg-6 col-md-12">
                <h3>Páginas</h3>
                @if(count($pages))
                @foreach($pages as $page)
                    <h4><a href="/muuch/{{ $page->id }}">{{ $page->name }}</a></h4>
                @endforeach
                @else
                <h3>:(</h3>
                @endif
            </div>
            <div class="col-lg-6 col-md-12">
                <h3>Recursos</h3>
                @if(count($contents))
                    @foreach($contents as $content)
                        <h4><a href="{{ $content->file }}" target="_blank">{{ $content->name }}</a></h4>
                    @endforeach
                @else
                <h3>:(</h3>
                @endif
            </div>
            <div class="col-sm-12">
                <br><br>
                <img src="/img/search-by-algolia.png" alt="Algolia" style="width:150px">
            </div>
    </div>

@endsection