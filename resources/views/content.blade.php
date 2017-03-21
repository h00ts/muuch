@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="panel panel-default display-content">
                <div class="panel-heading">
                    <h1 class="panel-title">{!! $content->name !!}</h1>
                </div>
                <div class="panel-body">
                    {!! $content->markup !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection