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
            <div class="col-lg-12">
                @foreach($results as $result)
                    <h2><a href="{{ $result->id }}">{{ $result->name }}</a></h2>
                @endforeach
            </div>
    </div>

@endsection