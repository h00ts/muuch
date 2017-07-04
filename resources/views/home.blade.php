@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <strong>Accesos rápidos:</strong> <a href="http://mail.ilumexico.mx" class="btn btn-default btn-sm btn-primary" style="margin:0"><i class="material-icons">mail_outline</i> Correo</a> <a href="http://sf.ilumexico.mx" class="btn btn-defult btn-sm btn-primary" style="margin:0"><i class="material-icons">backup</i> Salesforce</a> <a href="http://tinyurl.com/TWAPK440" class="btn btn-default btn-sm btn-primary" style="margin:0"><i class="material-icons">phone_android</i> Descarga TARO</a> <a href="http://vbx.ilumexico.mx" class="btn btn-default btn-sm btn-primary" style="margin:0" title="vbx@ilumexico.mx - prometeo1" data-toggle="tooltip" data-placement="bottom"><i class="material-icons">sms</i> SMS</a>
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
                                @php($hola = collect(["¡Hola!", "¡Pekarij abi!", "¡Ma'alob K'iin!", "¡Kwali Tlanextili!", "¡Sak Osil!", "¡A Va'a ntuu ni!", "¡Ketémáúbo'Kích'ahrín!",  "¡Najneajay larraw!", "¡Cualtsin Tlanextilistli!", "¡Guun Xta'a Güii!"]))
                                {!! $hola->random() !!}
                              </small><br>{!! $user->name !!}</h4>
                              <p class="list-group-item-text"><strong>Administrador</strong></p>
                              <p>{!! $user->email !!}</p>
                            </div>
                          </div>
                        </div>
                        @if($user->level === null)
                            <p>Inscribete a nuestra plataforma de capacitación para subir al nivel 1.</p>
                            <a href="/capacitacion/inscribir" class="btn btn-default btn-raised btn-block"><i class="material-icons">school</i>  Inscribirme</a>
                        @else
                            <h4 class="text-info">Nivel {!! ($user->level) ? $user->level : '0' !!} <span class="label pull-right">{!! isset($user->content) ? count($user->content) / $content_count * 100 . '%' : '0%' !!}</span></h4>
                            <div class="progress progress-striped active">
                              <div class="progress-bar {!! (count($user->content) == $content_count) ? 'progress-bar-primary' : 'progress-bar-warning' !!}" role="progressbar" aria-valuenow="{!! isset($user->content) ? number_format(count($user->content) / $content_count * 100, 2, '.', ',')  : '0' !!}" aria-valuemin="0" aria-valuemax="100" style="width: {!! isset($user->content) ? count($user->content) / $content_count * 100 . '%' : '0%' !!};">
                                {!! isset($user->content) ? number_format(count($user->content) / $content_count * 100, 0, '.', ',') . '%' : '0%' !!}
                              </div>
                            </div>
                            @if(count($user->content) == $content_count && count($user->scores) && \Carbon\Carbon::now()->subWeeks(2) > $user->scores->last()->created_at)
                                <h4 class="text-success"><i class="material-icons">thumb_up</i> ¡Buen trabajo!</h4>
                                <a href="/examen" class="btn btn-inverse btn-raised btn-block"><i class="material-icons">trending_up</i> TOMA EL EXAMEN</a>
                                <p>Toma el examen para pasar al siguiente nivel.</p>
                            @elseif(count($user->scores) && \Carbon\Carbon::now()->subWeeks(2) < $user->scores->last()->created_at)
                                 <h4 class="text-danger">Espera {{ \Carbon\Carbon::parse($user->scores->last()->created_at)->addWeeks(2)->diffInDays(\Carbon\Carbon::now()) }} dias para tomar tu examen nuevamente. Aprovecha para repasar el contenido de tu capacitación.</h4>
                            @elseif(count($user->content) == $content_count && !count($user->scores))
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
                            <div class="nav-tabs-navigation">
                              <div class="nav-tabs-wrapper">
                                <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                                  @foreach($categories->where('parent_id', 0) as $category)
                                    <li><a href="#{!! $category->name !!}" data-toggle="tab">{!! $category->name !!}</a></li>
                                  @endforeach
                                </ul>
                              </div>
                            </div>
                     
                            <div id="subcategorias" class="tab-content">
                              @foreach($categories->where('parent_id', 0) as $category)
                                <div class="tab-pane {!! ($categories->first()->id == $category->id) ? 'active' : 'fade' !!}" id="{!! $category->name !!}" data-tabs="tabs">
                                  @foreach($categories->where('parent_id', $category->id) as $subcategory)
                                    <a href="#{!! str_slug($subcategory->name) !!}" class="btn btn-sm btn-primary" data-toggle="tab"><i class="material-icons" style="font-size:18px">folder_open</i> {!! $subcategory->name !!}</a>
                                  @endforeach
                                  <ul class="nav nav-pill">
                                  @foreach($category->pages as $page)
                                    <li><a href="/muuch/{!! $page->id !!}"><i class="material-icons" style="font-size:18px">chevron_right </i>  {!! $page->name !!}</a></li>
                                  @endforeach
                                   </ul>
                                </div>
                              @endforeach
                            </div>
                            

                            <div id="muuch" class="tab-content">
                              @foreach($categories->where('parent_id', '>', 0) as $subcategory)
                                <div class="tab-pane fade in" id="{!! str_slug($subcategory->name) !!}" data-tabs="tabs">
                                  <hr>
                                  <ul class="nav nav-pill">
                                    @foreach($subcategory->pages as $page)
                                    <li><a href="/muuch/{!! $page->id !!}"><i class="material-icons" style="font-size:18px">chevron_right </i> {!! $page->name !!}</a></li>
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
                <h2 class="panel-title"><a href="/foro" class="link"><i class="material-icons">question_answer</i> <strong>Foro de Discuciónes</strong> <i class="material-icons pull-right">arrow_right</i> </a></h2>
              </div>
              <div class="panel-body">
                <table class="table table-hover">
                    <tr>
                      <th>Discusión</th>
                      <th><i class="material-icons" style="font-size:18px" title="Vistas" data-toggle="tooltip" data-placement="left">remove_red_eye</i></th>
                      <th><i class="material-icons" style="font-size:18px" title="Respuestas" data-toggle="tooltip" data-placement="left">comment</i></th>
                      <th><i class="material-icons" style="font-size:18px" title="Respuesta más reciente" data-toggle="tooltip" data-placement="left">access_time</i></th>
                  </tr>
                  @foreach($threads as $thread)
                  <tr>
                    <td><a href="/foro/{{ $thread->id }}" style="font-size:16px; display:block"><strong>{!! $thread->title !!}</strong></a> <small><i class="material-icons" style="font-size:12px">account_circle</i> {{ $thread->user->name }}</small></td>
                    <td><span class="label">{!! count($thread->replies) ? $thread->replies->count() : '0' !!}</span></td>
                    <td><span class="label">0</span></td>
                    <td>{{ \Carbon\Carbon::parse($thread->updated_at)->diffForHumans(\Carbon\Carbon::today()) }}</td>
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
