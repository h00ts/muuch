@extends('layouts.app')
@section('content')
    @permission('page-'.$page->slug)
        <div class="row">
            <div class="col-lg-12">
                <a href="{{ URL::previous() }}" class="btn btn-default pull-right">
                    <i class="material-icons">arrow_left</i> Regresar
                </a>
                <h3><i class="material-icons">people</i> {{ $name }}
                </h3>
                <hr>
                <p class="small"><i class="material-icons" style="font-size: 15px;">info</i> ¿Buscas información de contacto? La encontrarás en el
                    <a href="/directorio">directorio</a>.</p>
                <hr>
            </div>
        </div>
        <div class="personas">
            @foreach($users as $user)
                <div class="personas-col">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <img src="{{ (count($user->getMedia('profile'))) ? $user->getMedia('profile')->first()->getUrl() : '/img/default_avatar.png' }}" alt="" class="img-responsive circle">
                            <h4>{{ $user->name }} <br><small>{{ $user->ilucentro->name }}</small></h4>
                            <strong>{{ $user->posicion }}</strong>
                            <p>{{ $user->descripcion }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endpermission
@endsection

@section('scripts')

@endsection

