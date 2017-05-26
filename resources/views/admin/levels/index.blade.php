@extends('layouts.config')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Niveles</h2>
                 <ul class="breadcrumb">
                  <li><a href="/config">Configuración</a></li>
                  <li class="active">Capacitación</li>
                </ul>
                @include('admin.partials.alerts')
            </div>
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if(count($levels))
                        <div class="row">
                            @foreach($levels as $level)
                                <div class="col-md-6 col-lg-4">
                                 <a href="{!! route('niveles.edit', $level->first()->level) !!}" class="h1 text-center" style="display:block; border:1px solid #ddd; margin:.4em .25em; padding:.7em; border-radius:6px;">
                                 Nivel {!! ($level->first()->level > 9) ? $level->first()->level : '0'.$level->first()->level !!}
                                 </a>
                                </div>
                            @endforeach
                        </div>
                        @else
                        No hay niveles.
                        @endif
                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-link" id="button--show-box"><i class="glyphicon glyphicon-plus"></i> NUEVO NIVEL</button>
                        <div id="box--confirm" class="hidden">
                            Confirma crear un nuevo nivel: <button id="button--dismiss" class="btn btn-default"> No, regresar</button> | <button id="button--confirm" class="btn btn-primary" data-content="{!! $levels->max('level'); !!}">Si, crear</button>
                        </div>
                        <div class="hidden" id="state--loading"><i class="glyphicon glyphicon-refresh glyphicon-spin"></i> Creando...</div>
                    </div>
                </div>
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

            $('#button--show-box').on('click', function(){
                $('#button--show-box').hide();
                $('#box--confirm').removeClass('hidden');
            });

            $('#button--dismiss').on('click', function(){
                $('#button--show-box').show();
                $('#box--confirm').addClass('hidden');
            });

            $('#button--confirm').on('click', function(){
                $('#button--dismiss').attr('disabled', 'true');
                $('#button--confirm').attr('disabled', 'true');
                $('#box--confirm').hide();
                $('#state--loading').removeClass('hidden');
                $.ajax({
                    url: '{!! route('niveles.store') !!}',
                    type:"POST",
                    dataType: 'JSON',
                    success: function(result){
                        setTimeout(function(){
                            window.location.reload();
                        }, 200);
                    }
                });
            });
        });
    </script>
@endsection