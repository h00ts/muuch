@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <a href="{{ URL::previous() }}" class="btn btn-default pull-right">
                        <i class="material-icons">arrow_left</i> Regresar
                    </a> 
      <h3><a href="/foro"><i class="material-icons">forum</i> Foro</a> <i class="material-icons">chevron_right</i> <a href="/canal/{{ $thread->id }}">{{ $thread->channel->name }}</a> <i class="material-icons">chevron_right</i> {{ $thread->title }} </h3>
      <hr>
    </div>
  </div>
<div class="row">
    <div class="col-md-4">
        @include('layouts.profile')
    </div>
    <div class="col-md-8">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h2 class="panel-title">{{ $thread->user->name }} <span class="label label-primary">({{ $thread->user->ilucentro->name }})</span> <small>{{ \Carbon\Carbon::now()->parse($thread->created_at)->diffForHumans() }}</small> </h2>
        </div>
        <div class="panel-body">
          <div class="col-sm-2">
              <img src="{{ (count($thread->user->getMedia('profile'))) ? $thread->user->getMedia('profile')->first()->getUrl() : '/img/default_avatar.png' }}" alt="avatar" class="img-responsive circle">
          </div>
          <div class="col-sm-10"><p>{!! nl2br(e($thread->body)) !!}</p></div>
        </div>
      </div>
    @foreach($thread->replies as $reply)
      <div class="panel panel-default">
        <div class="panel-heading">
          <h2 class="panel-title">{{ $reply->user->name }} <span class="label label-default">({{ $reply->user->ilucentro->name }})</span> <small>{{ \Carbon\Carbon::now()->parse($reply->created_at)->diffForHumans() }}</small> </h2>
        </div>
        <div class="panel-body">
          <div class="col-sm-2">
              <img src="{{ (count($reply->user->getMedia('profile'))) ? $reply->user->getMedia('profile')->first()->getUrl() : '/img/default_avatar.png' }}" alt="avatar" class="circle img-responsive">
          </div>
          <div class="col-sm-10"><p>{!! nl2br(e($reply->body)) !!}</p></div>
        </div>
      </div>
    @endforeach
    <form action="{{ route('foro.responder', $thread->id) }}" method="POST">
      {{ csrf_field() }}
      <input type="hidden" name="channel_id" value="{{ $thread->channel_id }}">
      <input type="hidden" name="thread_id" value="{{ $thread->id }}">
      <div class="form-group">
        <label for="body">Responder</label>
      <textarea name="body" id="body" rows="5" class="form-control" required></textarea>
      </div>
      <input type="submit" class="btn btn-block btn-primary btn-raised" value="RESPONDER">
    </form>
        </div>
  </div>
</div>
@endsection
