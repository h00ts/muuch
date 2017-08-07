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
                        <p>Inscribete a nuestra plataforma de capacitación para subir al nivel 1.</p>
                        <a href="/capacitacion/inscribir" class="btn btn-default btn-raised btn-block"><i class="material-icons">school</i>  Inscribirme</a>
                    @else
                        <h4 class="text-default">Nivel {!! ($user->level) ? $user->level : '0' !!} <span class="label pull-right">{!! isset($user_content) ? $user_content / $content_count * 100 . '%' : '0%' !!}</span></h4>
                        <div class="progress progress-striped active">
                            <div class="progress-bar {!! ($user_content == $content_count) ? 'progress-bar-primary' : 'progress-bar-warning' !!}" role="progressbar"
                                 style="width: {!! ($user_content) ? ($user_content / $content_count * 100).'%' : '0%' !!};"
                                 aria-valuenow="{!! ($user_content) ? number_format($user_content / $content_count * 100, 2, '.', ',')  : '0' !!}"
                                 aria-valuemin="0"
                                 aria-valuemax="100">
                                {!! ($user_content) ? number_format($user_content / $content_count * 100, 0, '.', ',') . '%' : '0%' !!}
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
            <a href="/herramientas" class="btn btn-success btn-lg btn-block">
                <i class="material-icons">lightbulb_outline</i> Herramientas
            </a>
            <a href="/equipo" class="btn btn-success btn-lg btn-block">
                <i class="material-icons">people</i> Equipo
            </a>
            <a href="/sucursales" class="btn btn-success btn-lg btn-block">
                <i class="material-icons">store</i> Sucursales
            </a>
        </div>
        <div class="col-md-8">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><a href="/muuch" class="link"><i class="material-icons">accessibility</i> <strong>MUUCH</strong> <i class="material-icons pull-right">arrow_right</i> <span class="pull-right">Ir</span> </a></h3>
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
                            <small>Menu rápido</small>
                            <div class="nav-tabs-navigation">
                              <div class="nav-tabs-wrapper">
                                <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                                  @foreach($categories->where('parent_id', 0) as $category)
                                     @permission('category-'.$category->slug)
                                        <li{{ ($category->id == 1) ? ' class=active' : '' }}><a href="#{!! $category->slug !!}" data-toggle="tab">{!! $category->name !!}</a></li>
                                      @endpermission
                                  @endforeach
                                </ul>
                              </div>
                            </div>

                     
                            <div id="subcategorias" class="tab-content">
                              @foreach($categories->where('parent_id', 0) as $category)
                                <div class="nav tab-pane {!! ($categories->first()->id == $category->id) ? 'active' : 'fade' !!}" id="{!! $category->slug !!}" data-tabs="tabs">
                                    <ul class="nav nav-pills">
                                  @foreach($categories->where('parent_id', $category->id)->sortBy('name') as $subcategory)
                                        @permission('category-'.$subcategory->slug)
                                        <li><a href="#{!! str_slug($subcategory->name) !!}" data-toggle="tab"><i class="material-icons" style="font-size:18px">folder_open</i> {!! $subcategory->name !!}</a></li>
                                      @endpermission
                                  @endforeach
                                    </ul>
                                   <div id="muuch" class="tab-content">
                                    @foreach($categories->where('parent_id', '>', 0) as $subcategory)
                                      <div class="tab-pane fade in" id="{!! $subcategory->slug !!}" data-tabs="tabs">
                                        <ul class="nav nav-pill">
                                          @foreach($subcategory->pages->sortBy('name') as $page)
                                                @permission('page-'.$page->slug)
                                          <li><a href="/muuch/{!! $page->id !!}"><i class="material-icons" style="font-size:18px">chevron_right </i> {!! $page->name !!}</a></li>
                                              @endpermission
                                          @endforeach
                                        </ul>
                                      </div>
                                    @endforeach
                                  </div>

                                  <ul class="nav nav-pill">
                                  @foreach($category->pages->sortBy('name') as $page)
                                          @permission('page-'.$page->slug)
                                    <li><a href="/muuch/{!! $page->id !!}"><i class="material-icons" style="font-size:18px">chevron_right </i>  {!! $page->name !!}</a></li>
                                       @endpermission
                                  @endforeach
                                   </ul>
                                </div>
                              @endforeach
                            </div>
                            

                            
                        </div>
                    </div>
                </div>
            </div>
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
        </div>
    </div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(function () {
    $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endsection
