@extends('layouts.app')
@section('content')
<div class="container">
<div class="row">
		        <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="list-group">
                          <div class="list-group-item">
                            <div class="row-picture">
                              <img class="circle" src="/img/default_avatar.png" alt="icon">
                            </div>
                            <div class="row-content">
                              <h4 class="list-group-item-heading"><small>
                                @php($hola = collect(["¡Hola!", "Namaste", "Ní Haô!", "Shalom!", "Olá!", "Pribet!", "Konnichiwa",  "Hallo!", "Ciao!"]))
                                {!! $hola->random() !!}
                              </small><br>{!! $user->name !!}</h4>
                              <p class="list-group-item-text"><strong>Administrador</strong></p>
                              <p>{!! $user->email !!}</p>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
        </div>
{{ $thread->title }}
</div>
</div>
@endsection
