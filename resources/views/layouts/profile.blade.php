                <div class="panel panel-default">
                    <div class="panel-body">
                        <p class="text-center">
                          @php($hola = collect(["¡Hola!", "¡Pekarij abi! <small>(Matlatzinca)</small>", "¡Ma'alob K'iin! <small>(Maya)</small>", "¡Kwali Tlanextili! <small>(Náhuatl)</small>", "¡Sak Osil! <small>(Tsotsil)</small>", "¡A Va'a ntuu ni! <small>(Mixteco)</small>", "¡Ketémáúbo'Kích'ahrín! <small>(Chichimeco)</small>",  "¡Najneajay larraw! <small>(Huave)</small>", "¡Cualtsin Tlanextilistli! <small>(Náhuatl)</small>", "¡Guun Xta'a Güii! <small>(Triqui)</small>"])) {!! $hola->random() !!}
                        </p>
                        <div class="list-group">
                          <div class="list-group-item">
                            <div class="row-picture">
                              <img class="circle" src="/img/default_avatar.png" alt="icon">
                            </div>
                            <div class="row-content">
                              <h4 class="list-group-item-heading">{!! $user->name !!}</h4>
                              <p class="list-group-item-text"><strong>{{ $user->roles->first()->display_name }}</strong></p>
                              <p>{!! $user->email !!}</p>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>