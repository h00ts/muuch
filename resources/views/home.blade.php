@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-4">
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
                <div class="panel-body" style="padding:0">
                    <a href="https://s3-us-west-2.amazonaws.com/ilu-muuch/static/impacto.png" target="_blank"><img src="https://s3-us-west-2.amazonaws.com/ilu-muuch/static/impacto.png" alt="impacto" class="img-responsive"></a>
                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title text-white"><a href="#" class="link"><i class="material-icons">markunread_mailbox</i> <strong>Quejas y Sugerencias</strong></a> </h3>
                </div>
                <div class="panel-body">
                    <p><small>En éste buzón podrás dejar comentarios relativos al funcionamiento de la plataforma o a cualquier otro tema que quisieras abordar.</small></p> <small>Recuerda que es un buzón privado y sólo tendrá acceso a él el área de Personas.
                    <form action="/enviar/bsq" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="form-group">
                        <label for="mailbox">Escríbenos...</label>
                        <textarea name="message" id="mailbox" rows="5" class="form-control border-input"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Dejar en el Buzón</button>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-md-8">
            <div class="panel panel-bienvenida">
                <div class="panel-body">
                    <a href="/personas">
                        <span>EQUIPO</span>
                    </a>
                </div>
            </div>
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><a href="/consulta" class="link"><i class="material-icons">accessibility</i> <strong>Consulta</strong> <i class="material-icons pull-right">arrow_right</i> <span class="pull-right">Ir</span> </a></h3>
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
                            <a href="/consulta" class="btn btn-primary btn-raised">¡Empieza a consultar!</a>
                        </div>
                        {{--
                        <div class="col-sm-12">
                            <small>Menu rápido</small>
                            <div class="panel-group" id="menu-rapido" role="tablist" aria-multiselectable="true">
                                @foreach($categories->where('parent_id', 0) as $category)
                                    @if(count($category->pages->where('menu', 1)))
                                        @permission('category-'.$category->slug)
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="{{ 'heading-'.$category->slug }}" style="background-color: #FFF">
                                                <h4 class="panel-title text-primary">
                                                    <a role="button" class="btn btn-block btn-primary" style="margin:0;text-align:left" data-toggle="collapse" data-parent="#menu-rapido" href="#{!! $category->slug !!}" aria-expanded="false" aria-controls="{!! $category->slug !!}"> <i class="material-icons">folder_open</i> {!! $category->name !!} </a>
                                                </h4>
                                            </div>
                                            <div id="{!! $category->slug !!}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="{{ $category->slug }}">
                                                <ul class="list-group">
                                                    @foreach($category->pages->where('menu', 1) as $page)
                                                        <li class="list-group-item">
                                                            <a href="/consulta/{{ $page->id }}" class="btn btn-block btn-link btn-primary" style="text-align:left;margin:0 1px;padding:10px;"><i class="material-icons">chevron_right</i> {{ $page->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        @endpermission
                                    @endif

                                @endforeach
                                @foreach($categories->where('parent_id', 0) as $category)
                                        @if($category->slug == "formatos")
                                            <div class="panel panel-default">
                                                <div class="panel-heading" role="tab" id=heading-formatos" style="background-color: #FFF">
                                                    <h4 class="panel-title text-primary">
                                                        <a href="/formatos" class="btn btn-block btn-primary" style="margin:0;text-align:left"> <i class="material-icons">folder_open</i> Formatos </a>
                                                    </h4>
                                                </div>
                                            </div>
                                        @endif
                                @endforeach
                            </div>
                        </div> --}}

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
                            <th>Discusión más reciente</th>
                        </tr>
                        <tr>
                            <td><a href="/canal/{{ $thread->channel->id }}" class="pull-right" style="line-height: 50px;"># {{ $thread->channel->name }}</a> <a href="/foro/{{ $thread->id }}" style="font-size:16px; display:block" class="text-info"><strong>{!! $thread->title !!}</strong></a> <small><i class="material-icons" style="font-size:12px">account_circle</i> {{ $thread->user->name }} <i class="material-icons" style="font-size:12px">access_time</i> {{ \Carbon\Carbon::now()->parse($thread->created_at)->diffForHumans() }}</small> </td>
                        </tr>
                        <tr><td><a href="/foro" class="btn btn-sm btn-block btn-link">Ver todos los canales en el foro</a></td></tr>
                    </table>
                </div>
            </div>

{{-- -
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h2 class="panel-title"><a href="/foro" class="link"><i class="material-icons">question_answer</i> <strong>Foro de Discusiónes</strong> <i class="material-icons pull-right">arrow_right</i> <span class="pull-right">Ir</span>  </a></h2>
              </div>
              <div class="panel-body">
                <table class="table table-hover">
                    <tr>
                      <th>Discusión</th>
                      <th class="text-center"><i class="material-icons" style="font-size:18px" title="Vistas" data-toggle="tooltip" data-placement="left">remove_red_eye</i></th>
                      <th class="text-center"><i class="material-icons" style="font-size:18px" title="Respuestas" data-toggle="tooltip" data-placement="left">comment</i></th>
                      <th class="text-center"><i class="material-icons" style="font-size:18px" title="Actividad más reciente" data-toggle="tooltip" data-placement="left">access_time</i></th>
                  </tr>
                  @foreach($threads as $thread)
                  <tr>
                    <td><a href="/foro/{{ $thread->id }}" style="font-size:16px; display:block" class="text-info"><strong>{!! $thread->title !!}</strong></a> <small><i class="material-icons" style="font-size:12px">account_circle</i> {{ $thread->user->name }} <i class="material-icons" style="font-size:12px">access_time</i> {{ \Carbon\Carbon::now()->parse($thread->created_at)->diffForHumans() }}</small></td>
                    <td class="text-center" style="line-height:45px">{{ ($thread->views) ? $thread->views : '0' }}</td>
                    <td class="text-center" style="line-height:45px">{{ count($thread->replies) ? $thread->replies->count() : '0' }}</td>
                    <td class="text-right">
                      <small><i class="material-icons" style="font-size:12px">account_circle</i> {{ (count($thread->replies)) ? $thread->replies->last()->user->name : $thread->user->name }} <br> {{ (count($thread->replies)) ? \Carbon\Carbon::now()->parse($thread->replies->last()->created_at)->diffForHumans() : 'No hay respuestas :(' }}</small>
                    </td>
                  </tr>
                  @endforeach
                </table>
                <div class="text-right">
                  <a href="/foro/create" class="btn btn-primary btn-raised btn-sm"><i class="material-icons">chat</i> Nueva Discusión</a>
                </div>
              </div>
            </div>

            --}}
        </div>
    </div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>
@endsection
