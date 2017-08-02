@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <strong>Accesos rápidos:</strong> <a href="http://mail.ilumexico.mx" target="_blank" class="btn btn-default btn-sm btn-primary" style="margin:0"><i class="material-icons">mail_outline</i> Correo</a> <a href="http://sf.ilumexico.mx" target="_blank" class="btn btn-defult btn-sm btn-primary" style="margin:0"><i class="material-icons">backup</i> Salesforce</a> <a href="http://tinyurl.com/TWAPK440" target="_blank" class="btn btn-default btn-sm btn-primary" style="margin:0"><i class="material-icons">phone_android</i> Descarga TARO</a> <a href="http://vbx.ilumexico.mx" target="_blank" class="btn btn-default btn-sm btn-primary" style="margin:0" title="vbx@ilumexico.mx - prometeo1" data-toggle="tooltip" data-placement="bottom"><i class="material-icons">sms</i> SMS</a>
      <hr>
    </div>
  </div>
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
                                @php($hola = collect(["¡Hola!", "¡Pekarij abi! <small>(Matlatzinca)</small>", "¡Ma'alob K'iin! <small>(Maya)</small>", "¡Kwali Tlanextili! <small>(Náhuatl)</small>", "¡Sak Osil! <small>(Tsotsil)</small>", "¡A Va'a ntuu ni! <small>(Mixteco)</small>", "¡Ketémáúbo'Kích'ahrín! <small>(Chichimeco)</small>",  "¡Najneajay larraw! <small>(Huave)</small>", "¡Cualtsin Tlanextilistli! <small>(Náhuatl)</small>", "¡Guun Xta'a Güii! <small>(Triqui)</small>"]))
                                {!! $hola->random() !!}
                              </small><br>{!! $user->name !!}</h4>
                              <p class="list-group-item-text"><strong>{{ $user->roles->first()->display_name }}</strong></p>
                              <p>{!! $user->email !!}</p>
                            </div>
                          </div>
                        </div>
                        @if($user->level === null)
                            <p>Inscribete a nuestra plataforma de capacitación para subir al nivel 1.</p>
                            <a href="/capacitacion/inscribir" class="btn btn-default btn-raised btn-block"><i class="material-icons">school</i>  Inscribirme</a>
                        @else
                            <h4 class="text-success">Nivel {!! ($user->level) ? $user->level : '0' !!} <span class="label pull-right">{!! isset($user_content) ? $user_content / $content_count * 100 . '%' : '0%' !!}</span></h4>
                            <div class="progress progress-striped active">
                              <div class="progress-bar {!! ($user_content == $content_count) ? 'progress-bar-success' : 'progress-bar-warning' !!}" role="progressbar"
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
                <a href="/capacitacion" class="btn btn-primary btn-raised btn-lg btn-block">
                            <i class="material-icons">school</i> Mi Capacitación
                            </a>
        </div>
        <div class="col-md-8">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><a href="/muuch" class="link"><i class="material-icons">accessibility</i> <strong>MUUCH</strong> <i class="material-icons pull-right">arrow_right</i> </a></h3>
              </div>
                <div class="panel-body">
                    <div class="row">
                      <div class="col-sm-12">
                      <form action="/buscar" method="GET">
                          <div class="form-group" style="margin-top:0;">
                          <input type="text" class="form-control input-lg" placeholder="Buscar..." name="q">
                          </div>
                      </form>
                      </div>
                        <div class="col-sm-12">
                            <div class="nav-tabs-navigation">
                              <div class="nav-tabs-wrapper">
                                <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                                  @foreach($categories->where('parent_id', 0) as $category)
                                    <li><a href="#{!! $category->slug !!}" data-toggle="tab">{!! $category->name !!}</a></li>
                                  @endforeach
                                </ul>
                              </div>
                            </div>
                     
                            <div id="subcategorias" class="tab-content">
                              @foreach($categories->where('parent_id', 0) as $category)
                                <div class="tab-pane {!! ($categories->first()->id == $category->id) ? 'active' : 'fade' !!}" id="{!! $category->name !!}" data-tabs="tabs">
                                  @foreach($categories->where('parent_id', $category->id)->sortBy('name') as $subcategory)
                                    <a href="#{!! str_slug($subcategory->name) !!}" class="btn btn-sm btn-primary" data-toggle="tab"><i class="material-icons" style="font-size:18px">folder_open</i> {!! $subcategory->name !!}</a>
                                  @endforeach
                                  
                                   <div id="muuch" class="tab-content">
                                    @foreach($categories->where('parent_id', '>', 0) as $subcategory)
                                      <div class="tab-pane fade in" id="{!! str_slug($subcategory->name) !!}" data-tabs="tabs">
                                        <ul class="nav nav-pill">
                                          @foreach($subcategory->pages->sortBy('name') as $page)
                                          <li><a href="/muuch/{!! $page->id !!}"><i class="material-icons" style="font-size:18px">chevron_right </i> {!! $page->name !!}</a></li>
                                          @endforeach
                                        </ul>
                                      </div>
                                    @endforeach
                                  </div>

                                  <ul class="nav nav-pill">
                                  @foreach($category->pages->sortBy('name') as $page)
                                    <li><a href="/muuch/{!! $page->id !!}"><i class="material-icons" style="font-size:18px">chevron_right </i>  {!! $page->name !!}</a></li>
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
                <h2 class="panel-title"><a href="/foro" class="link"><i class="material-icons">question_answer</i> <strong>Foro de Discusiónes</strong> <i class="material-icons pull-right">arrow_right</i> </a></h2>
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
                    <td><a href="/foro/{{ $thread->id }}" style="font-size:16px; display:block"><strong>{!! $thread->title !!}</strong></a> <small><i class="material-icons" style="font-size:12px">account_circle</i> {{ $thread->user->name }} <i class="material-icons" style="font-size:12px">access_time</i> {{ \Carbon\Carbon::now()->parse($thread->created_at)->diffForHumans() }}</small></td>
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
        
        <div class="col-lg-12 text-center">
            <h2><i class="material-icons">accessibility</i></h2>
            <h4>La palabra MUUCH proviene del maya y significa "juntos". </h4>
            <p>
Esta plataforma fué creada con la intención de acercarnos y ayudarnos a construir un mejor ILUMÉXICO JUNTOS.<br> Te invitamos a explorar la plataforma, así como a enviarnos todos tus comentarios para enriquecerla.</p>
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
