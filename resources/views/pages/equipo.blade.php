@extends('layouts.app')
@section('content')
    @permission('page-'.$page->slug)
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <a href="{{ URL::previous() }}" class="btn btn-default pull-right">
                    <i class="material-icons">arrow_left</i> Regresar
                </a>
                <h3><i class="material-icons">store</i> {{ $name }}
                </h3>
                <hr>
            </div>
            <div class="col-lg-12 col-md-12">
                @foreach($users as $user)

                    <h3>{{ $user->name }}</h3>
                    <strong>{{ $user->puesto }}</strong>

                @endforeach
            </div>
        </div>
    </div>
    @endpermission
@endsection

@section('scripts')

@endsection

