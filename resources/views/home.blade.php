@extends('layouts.app')
@section('content')
    <div class="row">
        @if(! isset($user->phone))
            <div class="col-md-12">
                <div class="alert alert-success">
                    <form id="actualiza-celular" class="form-inline form-success">
                        <i class="material-icons pull-left" style="line-height:40px">warning</i>
                            <div class="form-group" style="margin:0;padding:0">
                                <label for="phone" style="color:#FFF"> &nbsp; Ayudanos a mantener nuestra información actualizada. Recuerdanos tu número de celular: </label>
                                <input type="text" name="phone" class="form-control" style="color:#FFF;margin-left:1em; margin-bottom:0;">
                                <button type="submit" class="btn btn-default btn-raised" style="margin:0">Actualizar</button>
                            </div>
                    </form>
                    <p id="celular-actualizado" class="text-center lead hidden">¡GRACIAS!</p>
                </div>
            </div>
        @endif
        <div class="col-md-4 col-sm-4">
          @include('layouts.profile')
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><a href="/capacitacion" class="link"><i class="material-icons">school</i> <strong>Capacitación</strong> <i class="material-icons pull-right">arrow_right</i> <span class="pull-right">Ir</span> </a></h3>
                </div>
                <div class="panel-body">
                    @if($user->level === null)
                        <p>Inscríbete a nuestra plataforma de capacitación para subir al nivel 1.</p>
                        <a href="/capacitacion/inscribir" class="btn btn-default btn-raised btn-block"><i class="material-icons">school</i>  Inscribirme</a>
                    @else
                        <h4 class="text-default">Nivel {!! ($user->level) ? $user->level : '0' !!} <span class="label pull-right">{!! isset($user_content) ? number_format($user_content / $content_count * 100) . '%' : '0%' !!}</span></h4>
                        <div class="progress progress-striped active">
                            <div class="progress-bar {!! ($user_content == $content_count) ? 'progress-bar-primary' : 'progress-bar-warning' !!}" role="progressbar"
                                 style="width: {!! ($user_content) ? ($user_content / $content_count * 100).'%' : '0%' !!};"
                                 aria-valuenow="{!! ($user_content) ? number_format($user_content / $content_count * 100, 2, '.', '')  : '0' !!}"
                                 aria-valuemin="0"
                                 aria-valuemax="100">
                                {!! ($user_content) ? number_format(($user_content / $content_count * 100), 0) . '%' : '0%' !!}
                            </div>
                        </div>
                        @if($user_content == $content_count && count($user->scores) && \Carbon\Carbon::now()->subWeeks(2) > $user->scores->last()->created_at)
                            <h4 class="text-success"><i class="material-icons">thumb_up</i> ¡Buen trabajo!</h4>
                            <a href="/examen" class="btn btn-inverse btn-raised btn-block"><i class="material-icons">trending_up</i> TOMA EL EXAMEN</a>
                            <p>Toma el examen para pasar al siguiente nivel.</p>
                        @elseif($user_content == $content_count && count($user->scores) && \Carbon\Carbon::now()->subWeeks(2) < $user->scores->last()->created_at)
                            <p class="text-danger">Espera {{ \Carbon\Carbon::parse($user->scores->last()->created_at)->addWeeks(2)->diffInDays(\Carbon\Carbon::now()) }} dias para tomar tu examen nuevamente. Aprovecha para repasar el contenido de tu capacitación.</p>
                        @elseif($user_content == $content_count && !count($user->scores))
                            <h4 class="text-success"><i class="material-icons">thumb_up</i> ¡Buen trabajo!</h4>
                            <a href="/examen" class="btn btn-inverse btn-raised btn-block"><i class="material-icons">trending_up</i> TOMA EL EXAMEN</a>
                            <p>Toma el examen para pasar al siguiente nivel.</p>
                        @endif
                    @endif
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title text-danger"><strong>Quejas y Sugerencias</strong></h3>
                </div>
                <div class="panel-body">
                    <form action="/enviar/bsq" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <p class="small text-muted"><small>En éste buzón podrás dejar comentarios relativos al funcionamiento de la plataforma o a cualquier otro tema que quisieras abordar. <br> Recuerda que es un buzón privado y sólo tendrá acceso a él el área de Personas.</small></p>
                        <div class="form-group" style="margin-top:0">
                            <textarea name="message" id="mailbox" rows="4" class="form-control border-input" placeholder="Escríbenos..."></textarea>
                         <button type="submit" class="btn btn-primary btn-block"><i class="material-icons">markunread_mailbox</i> Dejar en el Buzón</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-md-8 col-sm-8">

            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><a href="/consulta" class="link"><i class="material-icons">local_library</i> <strong>Consulta</strong> <i class="material-icons pull-right">arrow_right</i> <span class="pull-right">Ir</span> </a></h3>
              </div>
                <div class="panel-body">
                    <div class="row">
                      <div class="col-sm-12">
                      <form action="/buscar" method="GET">
                          <div class="form-group" style="margin-top:0;">
                          <input type="text" class="form-control input-lg" placeholder="Ingresa tu busqueda..." name="q">
                          </div>
                      </form>
                      </div>
                        <div class="col-sm-12">
                            <p><strong>Bienvenido al nuevo MUUCH.</strong> En esta sección podrás consultar todo el material existente en ILUMÉXICO. Encontrarás guías, manuales, formatos, directorios, informes y muchas cosas más.</p> <p>Utiliza la barra superior para buscar algo específico o <a href="/consulta">ingresa a la sección de "Consulta"</a> para buscarlo a través de categorías.</p>
                        </div>
                        </div>

                        </div>
                    </div>
                                <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-bienvenida panel-equipo">
                        <a href="/personas">Conoce al Equipo</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-bienvenida panel-impacto">
                        <a href="/impacto">Impacto Acumulado</a>
                    </div>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title"><a href="/foro" class="link"><i class="material-icons">question_answer</i> <strong>Foro de Discusiones</strong> <i class="material-icons pull-right">arrow_right</i> <span class="pull-right">Ir</span>  </a></h2>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <tr>
                            <th>Discusiones más recientes</th>
                        </tr>
                        @foreach($threads as $thread)
                            <tr>
                                <td><a href="/canal/{{ $thread->channel->id }}" class="pull-right" style="line-height: 50px;"># {{ $thread->channel->name }}</a> <a href="/foro/{{ $thread->id }}" style="font-size:16px; display:block" class="text-info"><strong>{!! $thread->title !!}</strong></a> <small><i class="material-icons" style="font-size:12px">account_circle</i> {{ $thread->user->name }} <i class="material-icons" style="font-size:12px">access_time</i> {{ \Carbon\Carbon::now()->parse($thread->created_at)->diffForHumans() }}</small> </td>
                            </tr>
                        @endforeach
                        <tr><td><a href="/foro" class="btn btn-sm btn-block btn-link">Ver todos los canales en el foro</a></td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#actualiza-celular').submit(function(event) {

            var formData = {
                'phone' : $('input[name=phone]').val(),
                'id' : {{ $user->id }},
                '_method' : 'PUT',
                '_token' : $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                type        : 'PUT', // define the type of HTTP verb we want to use (POST for our form)
                url         : '/perfil/'+formData.id, // the url where we want to POST
                data        : formData, // our data object
                dataType    : 'json', // what type of data do we expect back from the server
                encode      : true
            })
            // using the done promise callback
                .done(function(data) {

                    // log data to the console so we can see
                    console.log(data);


                        $('#actualiza-celular').addClass('hidden');
                        $('#celular-actualizado').removeClass('hidden');


                    // here we will handle errors and validation messages
                });

            // stop the form from submitting the normal way and refreshing the page
            event.preventDefault();
        });

    });
</script>
@endsection


