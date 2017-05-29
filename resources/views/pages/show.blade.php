@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2><strong>MUUCH</strong> {!! $page->name !!}
            <a href="/muuch" class="btn btn-default pull-right">
                <i class="material-icons">arrow_left</i> Regresar
            </a> 
            </h2>
        </div>
        <div class="col-lg-12">
            <div class="panel panel-default display--page">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1" id="page-display">
                            {!! $page->markdown !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
@endsection

@section('scripts')

@endsection