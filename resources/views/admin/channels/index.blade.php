@extends('layouts.config')
@section('title', 'Foro')
@section('icon', 'reply')
@section('content')
    <div class="container-fluid">
        <div class="row">
             <div class="col-lg-12">
                <a href="#" class="btn btn-primary"  data-toggle="modal" data-target="#channelModal">
                    <i class="glyphicon glyphicon-plus"></i> Canal de discución
                </a>
                <hr>
                @include('admin.partials.alerts')
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Canales</h4>
                    </div>
                    <div class="content table-responsive">
                        @foreach($channels as $channel)
                            <form action="{{ route('canales.update', $channel) }}" method="POST" id="form-{{ $channel->id }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group">
                                    <label for="{{ $channel->id }}-name">Titulo</label>
                                    <input type="text" value="{{ $channel->name }}" name="name" id="{{ $channel->id }}-name" class="form-control input-lg">
                                </div>
                                <div class="form-group">
                                    <label for="{{ $channel->id }}-description">Descripción</label>
                                    <input type="text" value="{{ $channel->description }}" name="description" id="{{ $channel->id }}-desctiption" class="form-control">
                                </div>
                                <button class="btn btn-primary" type="submit"><i class="material-icons" style="font-size:16px">save</i> Guardar</button>
                            </form>
                            <hr>
                        @endforeach
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
@section('modals')


<div class="modal fade" id="channelModal"
     tabindex="-1" role="dialog"
     aria-labelledby="channelModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{!! route('canales.store') !!}" id="module-form">
            {!! csrf_field() !!}
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Canal <span id="module-num"></span></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="new-name">Nombre</label>
                    <input type="text" name="name" id="new-name" class="form-control input-lg" required="required">
                </div>
                <div class="form-group">
                    <label for="new-description">Descripcion</label>
                    <input type="text" name="description" class="form-control" required="required" id="new-description" rows="5">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-default"
                        data-dismiss="modal">Cancelar</button>
      <button type="submit" class="btn btn-primary">
        Crear
      </button>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('scripts')
    <script type="text/javascript">
        $(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });
    </script>
@endsection