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
                              <p class="list-group-item-text"><strong>Ingeniero comunitario</strong></p>
                              <p>{!! $user->email !!}</p>
                            </div>
                          </div>
                        </div>
                        @if($user->level === null)
                            <p>Inscribete a nuestra plataforma de capacitación para subir al nivel 1.</p>
                            <a href="/capacitacion/inscribir" class="btn btn-default btn-raised btn-block"><i class="material-icons">school</i>  Inscribirme</a>
                            @else
                            <a href="/capacitacion" class="btn btn-danger btn-lg btn-block">
                            Mi Capacitación
                            </a>
                            <h4 class="text-info">Nivel {!! ($user->level) ? $user->level : '0' !!} <span class="label pull-right">{!! isset($user->content) ? count($user->content) / $content_count * 100 . '%' : '0%' !!}</span></h4>
                            <div class="progress progress-striped active">
                              <div class="progress-bar {!! (count($user->content) == $content_count) ? 'progress-bar-primary' : 'progress-bar-warning' !!}" role="progressbar" aria-valuenow="{!! isset($user->content) ? number_format(count($user->content) / $content_count * 100, 2, '.', ',')  : '0' !!}" aria-valuemin="0" aria-valuemax="100" style="width: {!! isset($user->content) ? count($user->content) / $content_count * 100 . '%' : '0%' !!};">
                                {!! isset($user->content) ? number_format(count($user->content) / $content_count * 100, 0, '.', ',') . '%' : '0%' !!}
                              </div>
                            </div>
                            @if(count($user->content) == $content_count)
                                <h2 class="text-success">¡Buen trabajo! <i class="material-icons">thumb_up</i></h2>
                                <p class="lead">Terminaste de estudiar los modulos.</p>
                                <a href="/examen" class="btn btn-inverse btn-raised btn-block"><i class="material-icons">trending_up</i> TOMA EL EXAMEN</a>
                                <p>Toma el examen y averigua si aplicas para pasar al siguiente nivel.</p>
                            @endif
                        @endif
                    </div>
                </div>
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
                                    <a href="#{!! str_slug($subcategory->name) !!}" class="btn btn-sm btn-primary" data-toggle="tab">{!! $subcategory->name !!}</a>
                                  @endforeach
                                </div>
                              @endforeach
                            </div>

                            

                            <div id="muuch" class="tab-content">
                              @foreach($categories->where('parent_id', '>', 0) as $subcategory)
                                <div class="tab-pane fade in" id="{!! str_slug($subcategory->name) !!}" data-tabs="tabs">
                                  <hr>
                                  <ul class="nav nav-pill">
                                    @foreach($subcategory->pages as $page)
                                    <li><a href="/muuch/{!! $page->id !!}">{!! $page->name !!}</a></li>
                                    @endforeach
                                    <li><a href="/muuch/cat/{!! $subcategory->id !!}">Todos los {!! $subcategory->name !!}...</a></li>
                                  </ul>
                                </div>
                              @endforeach
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <div class="panel panel-warning">
              <div class="panel-heading">
                <h2 class="panel-title"><a href="/foro" class="link"><i class="material-icons">question_answer</i> <strong>Foro de Discución</strong> <i class="material-icons pull-right">arrow_right</i> </a></h2>
              </div>
              <div class="panel-body">
                <table class="table table-hover">
                    <tr>
                    <th>Discusión</th>
                    <th>Autor</th>
                    <th>Re:</th>
                    <th>Visto</th>
                    <th>Reciente</th>
                  </tr>
                  @foreach($threads as $thread)
                  <tr>
                    <td><a href="/foro/{!! $thread->id !!}" style="font-size:16px"><strong>{!! $thread->title !!}</strong></a></td>
                    <td><p class="small"><a href="{!! $thread->user->id !!}">{!! $thread->user->name !!}</a><br><small>{!! $thread->created_at->format('d M') !!}</small></p></td>
                    <td>{!! $thread->replies->count() !!}</td>
                    <td>47</td>
                    <td><p class="small"><a href="{!! $thread->replies->last()->user->id !!}">{!! $thread->replies->last()->user->name !!}</a><br><small>{!! $thread->replies->last()->created_at->format('d M') !!}</small></p></td>
                  </tr>
                  @endforeach
                </table>
                <a href="#" class="btn btn-default">Nueva Discusión</a>
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
