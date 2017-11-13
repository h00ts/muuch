
                        <div class="list-group">
                          <div class="list-group-item">
                            <div class="row-picture">
                                <img src="{{ (count($user->getMedia('profile'))) ? $user->getMedia('profile')->first()->getUrl() : '/img/default_avatar.png' }}" alt="avatar" class="img-responsive circle">
                            </div>
                            <div class="row-content">
                              <h4 class="list-group-item-heading">{!! $user->name !!}</h4>
                              <p class="list-group-item-text"><strong>{{ $user->roles->first()->display_name }}</strong></p>
                              <p>{!! $user->email !!}</p>
                            </div>
                          </div>
                        </div>
