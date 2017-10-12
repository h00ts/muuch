@extends('layouts.config')
@section('title', 'Capacitación')
@section('icon', 'school')
@section('slug', 'capacitacion')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('admin.partials.alerts')
            </div>
            <div class="col-lg-12">
                <button class="btn btn-primary" id="button--show-box"><i class="glyphicon glyphicon-plus"></i> Crear Nivel</button>
                        <div id="box--confirm" class="hidden">
                            Confirma crear un nuevo nivel: <button id="button--dismiss" class="btn btn-default"> No, regresar</button> | <button id="button--confirm" class="btn btn-primary" data-content="{!! $levels->max('level'); !!}">Si, crear</button>
                        </div>
                        <div class="hidden" id="state--loading"><i class="glyphicon glyphicon-refresh glyphicon-spin"></i> Creando...</div>
                        <hr>
                <div class="card">
                    <div class="content">
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
                   </div></div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="content">
                        <table class="table table-responsive table-striped">
                            <thead>
                                <tr>
                                    <td>Usuario</td>
                                    <td>Nivel | Modulo</td>
                                    <td>Examen</td>
                                    <td>Calificación</td>
                                    <td>Fecha</td>
                                </tr>

                            </thead>
                            <tbody>
                            @foreach($scores->sortByDesc('created_at') as $score)
                                <tr>
                                    <td><a href="/config/usuarios/{{ $score->user->id }}">{{ $score->user->name }}</a></td>
                                    <td>{{ $score->exam->module->level.' | 0'.$score->exam->module->module }}</td>
                                    <td>{{ $score->exam->name }}</td>
                                    <td>{{ $score->percent }}</td>
                                    <td>{{ $score->created_at->format('d/m/y H:i') }}</td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
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