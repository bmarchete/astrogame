<!-- settings modal -->
<div id="settings" class="uk-modal">
    <div class="uk-modal-dialog">
        <a href="" class="uk-modal-close uk-close"></a>
        <h2>{{ trans('game.config') }}</h2>
        <form class="uk-form">
            <div class="uk-form-row">
                <div class="uk-form-controls">
                    <label class="uk-form-label" for="enable-sound">
                        <i class="uk-icon-volume-off"></i>
                        <input id="volume-effects" type="range" min="0" max="100" value="100"> <i class="uk-icon-volume-up"></i> {{ trans('game.volume-sound') }}
                    </label>
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-form-controls">
                    <label class="uk-form-label" for="enable-music">
                        <i class="uk-icon-volume-off"></i>
                        <input id="volume-music" type="range" min="0" max="100" value="{{ $music_volume }}"> <i class="uk-icon-music"></i> {{ trans('game.volume-music') }}
                    </label>
                </div>
            </div>
            <div class="uk-form-row">
                <div class="uk-form-controls">
                    <div class="uk-form-select" data-uk-form-select>
                        <select id="lang-select" name="lang">
                            <option value="pt-br" @if ($lang=='pt-br' ) selected @endif>Português Brasileiro</option>
                            <option value="en" @if ($lang=='en' ) selected @endif>English</option>
                        </select>
                        <label for="lang"><i class="uk-icon-language"></i> {{ trans('game.language') }}</label>
                    </div>
                </div>
            </div>
        </form>
        <div class="uk-margin-top">
            @if($tutorial)
              <button class="uk-button uk-button-danger" id="tutorial-done">Desativar Tutorial <i class="uk-icon-close"></i></button>
              <button class="uk-button uk-button-primary" id="tutorial-again" style="display:none">Ativar Tutorial <i class="uk-icon-exclamation"></i></button>
            @else
              <button class="uk-button uk-button-primary" id="tutorial-again">Ativar Tutorial <i class="uk-icon-exclamation"></i></button>
              <button class="uk-button uk-button-danger" id="tutorial-done" style="display:none">Desativar Tutorial <i class="uk-icon-close"></i></button>
            @endif
        </div>
    </div>
</div>
<!-- bug report modal -->
<form id="bug-report" method="POST" action="{{ URL('/game/report') }}" class="uk-form">
    {!! csrf_field() !!}
    {!! Honeypot::generate('form_name', 'form_time') !!}
    <div id="bug-report-modal" class="uk-modal">
        <div class="uk-modal-dialog">
            <a href="" class="uk-modal-close uk-close"></a>
            <div class="uk-modal-header">
                <h2>{{ trans('game.bug-title') }}</div>
                <div class="uk-form-row">
                    <p class="uk-text-muted">Você pode nos enviar sugestões de novas fases, ideias de jogos, melhorias, erros que estão acontecendo no jogo, críticas, e qualquer outra ideia que vier a sua mente.</p>
                    <div class="uk-form-controls">
                        <textarea name="text" minlength="10" rows="5" style="width: 100%" required></textarea>
                    </div>
                </div>
            <div class="uk-modal-footer uk-text-right">
                <div class="uk-button-group">
                    <button class="uk-modal-close uk-button uk-button-danger"><i class="uk-icon-trash"> </i> {{ trans('game.cancel') }}</button>
                    <button type="submit" class="uk-button uk-button-primary"><i class="uk-icon-send"></i> {{ trans('game.submit') }}</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- shop modal -->
<div id="shop" class="uk-modal">
    <div class="uk-modal-dialog">
        <a href="" class="uk-modal-close uk-close"></a>
        <div class="uk-modal-header">
            <h3 class="uk-panel-header">{{ trans('game.shop-name') }}</h3>
        </div>

        <ul class="uk-tab" data-uk-tab="{connect:'#tab-shop'}" data-uk-check-display>
            <li aria-expanded="true" class="uk-active"><a href="#"><i class="uk-icon-space-shuttle"></i> Instrumentos óticos</a></li>
            <li class="" aria-expanded="false"><a href="#"><i class="uk-icon-book"></i> Livros</a></li>
            <li class="" aria-expanded="false"><a href="#"><i class="uk-icon-steam"></i> Insignas</a></li>
        </ul>

        <ul id="tab-shop" class="uk-switcher uk-margin">
            @foreach($shop as $category)
            <li aria-hidden="false" class="uk-active">
                <ul class="uk-list bag">
                @foreach($category as $item)
                    <li>
                        @if ($item->max_stack > 1)
                        <span class="uk-badge uk-badge-danger" title="{{ trans('game.item-max') }}" data-uk-tooltip>{{ $item->max_stack }}</span>
                        @endif
                        <figure class="uk-thumbnail uk-text-center buy-item" onclick="buy_item({{ $item->id }});">
                            <img src="{{ url('/img/items') }}/{{ $item->img_url }}.png" alt="" title="{{ $item->name }}" data-uk-tooltip >
                        </figure>
                        <figcaption class="uk-align-center uk-text-center">
                            <span class="price" title="Preço" data-uk-tooltip><i class="uk-icon-money"></i> {{ $item->price }}</span>
                        </figcaption>
                    </li>
                @endforeach
                </ul>
            </li>
            @endforeach
        </ul>
    </div>
</div>

<!-- insignas details modal -->
@forelse($all_insignas as $insigna)
<div id="insigna-{{ $insigna->id }}" class="uk-modal">
    <div class="uk-modal-dialog">
        <a href="#" class="uk-modal-close uk-close"></a>
        <h3>{{ $insigna->name }}</h3>

        <div class="uk-grid" data-uk-grid>
            <div class="uk-width-1-4">
                <figure class="uk-thumbnail uk-border-circle">
                    <img src="{{ url('/img/insignias') }}/{{ $insigna->img_url }}.png" alt="" data-uk-tooltip title="{{ $insigna->name }}">
                </figure>
            </div>
            <div class="uk-width-3-4">
                <h3>Descrição</h3>
                <p>{{ $insigna->reason }}</p>

                <h3>Como conseguir?</h3>
                <p>{{ $insigna->how }}</p>
            </div>
        </div>

    </div>
</div>
@endforeach

<!-- player modal -->
<div id="player-modal" class="uk-modal">
    <div class="uk-modal-dialog uk-modal-dialog-large">
        <a href="" class="uk-modal-close uk-close"></a>

        <ul class="uk-tab" data-uk-tab="{connect:'#tab-content'}" data-uk-check-display>
            <li aria-expanded="true" class="uk-active"><a href="#"><i class="uk-icon-user"></i> {{ trans('game.profile') }}</a></li>
            <li class="" aria-expanded="false"><a href="#"><i class="uk-icon-cog"></i> {{ trans('game.account') }}</a></li>
            <li class="" aria-expanded="false"><a href="#"><i class="uk-icon-shopping-bag"></i> {{ trans('game.bag') }}</a></li>
            <li class="" aria-expanded="false"><a href="#"><i class="uk-icon-graduation-cap"></i> {{ trans('game.patents') }}</a></li>
            <li class="" aria-expanded="false"><a href="#"><i class="uk-icon-bookmark"></i> {{ trans('game.insignas') }}</a></li>
            <li><a href="{{ url('/ranking')}}"><i class="uk-icon-cubes"></i> Ranking</a></li>
        </ul>

<ul id="tab-content" class="uk-switcher uk-margin">
    <li class="uk-active">
        <div class="uk-grid" data-uk-grid>
            <div class="uk-width-medium-1-6">
                <figure class="uk-thumbnail uk-border-circle">
                  <div class="uk-form-file">
                      <img src="{{ auth()->user()->avatar() }}" alt="avatar" class="uk-border-circle avatar" style="width: 130px">
                      <input type="file" name="avatar" accept="image/*" id="avatar-file" data-uk-tooltip title="Alterar avatar">
                  </div>
                </figure>
                <div>
                  <a id="remove-avatar"><i class="uk-icon-trash"></i> Remover avatar</a>
                </div>
            </div>
            <div class="uk-width-medium-5-6">
                <ul class="uk-list">
                    <li><i class="uk-icon-medium uk-icon-level-up level" data-uk-tooltip title="{{ trans('game.level') }}"></i> {{ $user_level }} ({{ auth()->user()->patente() }})</li>
                    <li><i class="uk-icon-medium uk-icon-money" data-uk-tooltip title="Astrocoins"></i> DG {{ $user_money }}</li>
                </ul>
                <div class="uk-margin-bottom">
                  XP: {{ $xp_bar }}% ({{ $user_xp }} XP)
                  <div class="uk-progress uk-progress-striped uk-text-center" data-uk-tooltip title="{{ $user_xp }} / {{ $xp_for_next_level }}">
                      <div class="uk-progress-bar" style="width: {{ $xp_bar }}%;"></div>
                  </div>
              </div>
                <a href="{{ url('/player')}}/{{ auth()->user()->nickname }}">{{ trans('game.profile-public') }}</a>
            </div>
        </div>
    </li>
  <li>
      <div class="uk-grid" data-uk-grid>
          <div class="uk-width-1-1">
            <form method="post" action="{{ url('/game/change_account') }}" class="uk-form user-config" enctype="multipart/form-data">
                  {!! csrf_field() !!}
                  <h3>Básico</h3>
                  <div class="uk-grid" data-uk-grid>
                    <div class="uk-width-medium-1-2">
                        <label class="uk-form-label" for="text">{{ trans('game.name') }}:</label>
                        <div class="uk-form-controls">
                            <input type="text" name="name" value="{{ auth()->user()->name }}" class="uk-width-1-1">
                        </div>
                    </div>

                    <div class="uk-width-medium-1-2">
                        <label class="uk-form-label" for="text">{{ trans('game.nickname') }}:</label>
                        <div class="uk-form-controls">
                            <input type="text" name="nickname" value="{{ auth()->user()->nickname }}" class="uk-width-1-1">
                        </div>
                    </div>

                    <div class="uk-width-medium-1-2">
                        <label class="uk-form-label" for="text">{{ trans('game.email') }}:</label>
                        <div class="uk-form-controls">
                            <input type="email" name="email" value="{{ auth()->user()->email }}" class="uk-width-1-1"
                            @if (!empty(auth()->user()->provider_id))
                            disabled
                            @endif
                            >
                        </div>
                    </div>

                    @if (empty(auth()->user()->provider_id))
                      <div class="uk-width-medium-1-1 uk-margin-top">
                          <h3>{{ trans('game.change-password') }}</h3>
                      </div>
                      <div class="uk-width-medium-1-2">
                          <label class="uk-form-label" for="text">{{ trans('game.old-password') }}:</label>
                          <div class="uk-form-controls">
                              <input type="password" name="old_password" class="uk-width-1-1">
                          </div>
                      </div>
                      <div class="uk-width-medium-1-2">
                          <label class="uk-form-label" for="text">{{ trans('game.new-password') }}:</label>
                          <div class="uk-form-controls">
                              <input type="password" name="new_password" class="uk-width-1-1">
                          </div>
                      </div>
                    @endif
                  </div>

                  <button type="submit" class="uk-button uk-button-success uk-align-right uk-margin-top"><i class="uk-icon-check"></i> Salvar alterações</button>

                  <div class="uk-align-right uk-margin-top">
                    <div class="uk-button-group" data-uk-switcher>
                        <button aria-expanded="true" class="uk-button @if($profile_private == false) uk-active @endif uk-button-primary" type="button" id="public">Pefil Público <i class="uk-icon-globe"></i></button>
                        <button aria-expanded="false" class="uk-button @if($profile_private) uk-active @endif uk-button-danger" type="button" id="private">Perfil Privado <i class="uk-icon-user-secret"></i></button>
                    </div>
                  </div>

                  @if (!empty(auth()->user()->provider_id))
                      <button class="uk-button uk-button-success uk-disabled uk-align-right uk-margin-top" disabled>
                          @if (auth()->user()->provider_id == 1)
                            <i class="uk-icon-facebook"></i> Vinculado com o Facebook <i class="uk-icon-check"></i>
                          @elseif (auth()->user()->provider_id == 2)
                            <i class="uk-icon-google"></i> Vinculado com o Google <i class="uk-icon-check"></i>
                          @endif
                      </button>
                  @endif
              </form>
          </div>
      </div>
  </li>
  <li>
      <div class="uk-panel uk-panel-box uk-panel-box-primary">
          <h3 class="uk-panel-title"><i class="uk-icon-shopping-bag"> </i> {{ trans('game.bag') }}</h3>
          <ul class="uk-list bag bag-items">
              <li></li>
              @forelse($bag as $bag_item)
              <li onclick="remove_item({{ $bag_item->item->id }});" class="item-{{ $bag_item->item->id }}">
                  <span class="uk-badge uk-badge-success">{{ $bag_item->amount }}</span>
                  <figure class="uk-thumbnail">
                      <img src="{{ url('/img/items') }}/{{ $bag_item->item->img_url }}.png" alt="" data-uk-tooltip title="{{ $bag_item->item->name }}">
                  </figure>
              </li>
              @empty {{ trans('game.empty-bag') }} @endforelse
          </ul>
      </div>
  </li>
  <li>
      <dl class="uk-description-list-line">
          <dt>
              <strong>Level (0-3)</strong> {{ trans('game.patent1')}}
              @if ($user_level <= 3)
              <div class="uk-badge uk-badge-warning">Você está aqui</div>
              @endif

              <div class="uk-text-muted">{{ trans('game.patent1-description')}}</div>
          </dt>
          <dt>
              <strong>Level (4-6)</strong> {{ trans('game.patent2')}}
              @if ($user_level >= 4 && $user_level <= 6)
              <div class="uk-badge uk-badge-warning">Você está aqui</div>
              @endif
              <div class="uk-text-muted">{{ trans('game.patent2-description')}}</div>
          </dt>
          <dt>
              <strong>Level (7-9)</strong> {{ trans('game.patent3')}}
              @if ($user_level >= 7 && $user_level <= 9)
              <div class="uk-badge uk-badge-warning">Você está aqui</div>
              @endif
              <div class="uk-text-muted">{{ trans('game.patent3-description')}}</div>
          </dt>
          <dt>
              <strong>Level (10-12)</strong> {{ trans('game.patent4')}}
              @if ($user_level >= 10 && $user_level <= 12)
              <div class="uk-badge uk-badge-warning">Você está aqui</div>
              @endif
              <div class="uk-text-muted">{{ trans('game.patent4-description')}}</div>
          </dt>
          <dt>
              <strong>Level (13-14)</strong> {{ trans('game.patent5')}}
              @if ($user_level >= 13 && $user_level <= 14)
              <div class="uk-badge uk-badge-warning">Você está aqui</div>
              @endif
              <div class="uk-text-muted">{{ trans('game.patent5-description')}}</div>
          </dt>
          <dt>
              <strong>Level (15)</strong> {{ trans('game.patent6')}}
              @if ($user_level >= 15)
              <div class="uk-badge uk-badge-warning">Você está aqui</div>
              @endif
              <div class="uk-text-muted">{{ trans('game.patent6-description')}}</div>
          </dt>
      </dl>
  </li>
  <li>
      <ul class="uk-list insignas" style="overflow-y: scroll; height: 400px">
          @forelse($all_insignas as $insigna)
          @if(auth()->user()->insignas->contains($insigna))
          <li>
              <figure data-uk-modal="{target:'#insigna-{{ $insigna->id }}'}" class="uk-thumbnail uk-border-circle" style="width: 100px">
                  <img src="{{ url('/img/insignias') }}/{{ $insigna->img_url }}.png" alt="" data-uk-tooltip title="{{ $insigna->name }}">
              </figure>
          </li>
          @else
          <li>
              <figure data-uk-modal="{target:'#insigna-{{ $insigna->id }}'}" class="uk-thumbnail uk-border-circle gray" style="width: 100px">
                  <img src="{{ url('/img/insignias') }}/{{ $insigna->img_url }}.png" alt="" data-uk-tooltip title="Como eu consigo essa insigna?">
              </figure>
          </li>

          @endif
          @empty
          {!! trans('game.empty-insignas') !!}
          @endforelse
      </ul>
      <p><i class="uk-icon-exclamation-circle"></i> Uma insigna cinza significa que você ainda não conquistou ela ainda!</p>
  </li>
  <li>
    <h4>Ranking Global</h4>
    <ul class="uk-list uk-list-striped ranking-list">
      @forelse ($ranking as $player)
      <li>
          <div class="uk-border-circle uk-hidden-small" style="width: 60px; display: inline-block">
              <a href="{{ url('/player') . '/' . $player->nickname }}">
                <img src="{{ $player->avatar() }}" alt="{{ $player->name }} avatar" class="uk-border-circle avatar">
              </a>
          </div>
          <ul class="uk-list" style="display: inline-block;">
              <li># <strong>{{ $player->row}}</strong> &nbsp; <a href="{{ url('/player') . '/' . $player->nickname }}"><strong>{{ $player->name }}</strong></a> ({{ $player->patente() }})</li>
              <li><i class="uk-icon-exclamation"></i> Level: {{ $player->level }} - ({{$player->xp}} XP)</li>
          </ul>
      </li>
      @empty
        <p>Acho que ninguém começou a jogar ainda :(</p>
      @endforelse
    </ul>
  </li>
</ul>
</div>
</div>

<!-- quests modal -->
<div id="quests" class="uk-modal">
    <div class="uk-modal-dialog">
        <a href="" class="uk-modal-close uk-close"></a>
        <div class="uk-modal-header">
            <h3 class="uk-panel-header">{{ trans('game.quests') }} <span class="uk-badge uk-badge-warning">!</span></h3>
        </div>

        <ul class="uk-tab" data-uk-tab="{connect:'#tab-quests'}" data-uk-check-display>
            <li aria-expanded="true" class="uk-active"><a href="#"><i class="uk-icon-exclamation"></i> Quests Disponíveis</a></li>
            <li aria-expanded="true"><a href="#"><i class="uk-icon-exclamation-triangle"></i> Quests Aceitas</a></li>
        </ul>

<ul id="tab-quests" class="uk-switcher uk-margin">
    <li class="uk-active">
      @if (!empty($avaliable_quests->first()))
      <div class="uk-grid" data-uk-grid>
          <div class="uk-width-medium-1-3 uk-text-center uk-margin-bottom">
              <h3>{{ trans('game.quest-avaliable') }}</h3>

              @foreach ($avaliable_quests as $quest)
              <div class="uk-hidden" id="quest-title-{{$quest->id}}">{{ $quest->title }}</div>
              <div class="uk-hidden" id="quest-name-{{$quest->id}}">{{ $quest->name }}</div>
              <div class="uk-hidden" id="quest-description-{{$quest->id}}">{!! $quest->description !!}</div>
              <div class="uk-hidden" id="quest-objetivos-{{$quest->id}}">{!! $quest->objetivos !!}</div>
              <div class="uk-hidden" id="xp-reward-{{$quest->id}}">{{ $quest->xp_reward }}</div>
              <div class="uk-hidden" id="money-reward-{{$quest->id}}">{{ $quest->money_reward }}</div>
              @endforeach
              <select class="uk-form-select quest-avaliable">
                  @foreach ($avaliable_quests as $quest)
                  <option value="{{ $quest->id }}">{{$quest->title}}</option>
                  @endforeach
              </select>
          </div>
          <div class="uk-width-medium-2-3 uk-overflow-container">
              <div style="height: 160px; overflow-y: scroll">
                  <h3 class="quest-title">{{ $avaliable_quests->first()->title }}</h3>
                  <p class="quest-description">{!! $avaliable_quests->first()->description !!}</p>
                  <h5><strong>Objetivos</strong></h5>
                  <p class="quest-objetivos">{!! $avaliable_quests->first()->objetivos !!}</p>
              </div>
              <h3>{{ trans('game.quest-reward') }}</h3>
              <div class="uk-grid" data-uk-grid>
                  <div class="uk-width-2-4">
                      <span><i class="uk-icon-money"></i> <span class="money-reward">{{ $avaliable_quests->first()->money_reward }}</span></span> /
                      <span><i class="uk-icon-exclamation"></i> <span class="xp-reward">{{ $avaliable_quests->first()->xp_reward }}</span> XP</span>
                  </div>
                  <div class="uk-width-2-4 uk-text-right">
                      <button class="uk-button uk-button-success accept-quest" value="{{ $avaliable_quests->first()->id }}">{{ trans('game.quest-get') }} <i class="uk-icon-exclamation"></i></button>
                  </div>
              </div>
          </div>
      </div>
      @else
        <p>Parece que não há nenhuma quest disponível :(</p>
      @endif
    </li>
    <li>
      @if (!empty($accepted_quests->first()))
      <div class="uk-grid" data-uk-grid>
          <div class="uk-width-medium-1-3 uk-text-center uk-margin-bottom">
              <h3>{{ trans('game.quest-accepted') }}</h3>

              @foreach ($accepted_quests as $quest)
                <div class="uk-hidden" id="quest-title-{{$quest->id}}">{{ $quest->title }}</div>
                <div class="uk-hidden" id="quest-name-{{$quest->id}}">{{ $quest->name }}</div>
                <div class="uk-hidden" id="quest-description-{{$quest->id}}">{{ $quest->description }}</div>
                <div class="uk-hidden" id="xp-reward-{{$quest->id}}">{{ $quest->xp_reward }}</div>
                <div class="uk-hidden" id="money-reward-{{$quest->id}}">{{ $quest->money_reward }}</div>
              @endforeach
              <select class="uk-form-select quest-avaliable">
                  @foreach ($accepted_quests as $quest)
                  <option value="{{ $quest->id }}">{{$quest->title}}</option>
                  @endforeach
              </select>
          </div>

          <div class="uk-width-medium-2-3 uk-overflow-container">
              <div style="height: 160px; overflow-y: scroll">
                <h3 class="quest-title">{{ $accepted_quests->first()->title }}</h3>
                <p class="quest-description">{!! $accepted_quests->first()->description !!}</p>
                <h5><strong>Objetivos</strong></h5>
                <p class="quest-objetivos">{!! $accepted_quests->first()->objetivos !!}</p>
              </div>
              <h3>{{ trans('game.quest-reward') }}</h3>
              <div class="uk-grid" data-uk-grid>
                  <div class="uk-width-2-4">
                      <span><i class="uk-icon-money"></i> <span class="money-reward">{{ $accepted_quests->first()->money_reward }}</span></span> /
                      <span><i class="uk-icon-exclamation"></i> <span class="xp-reward">{{ $accepted_quests->first()->xp_reward }}</span> XP</span>
                  </div>
                  <div class="uk-width-2-4 uk-text-right">
                      <a href="{{ URL('/game/quest') . '/' . $accepted_quests->first()->name }}" class="uk-button uk-button-danger return-quest">Retornar a missão <i class="uk-icon-external-link"></i></a>
                  </div>
              </div>
          </div>
      </div>
      @else
          <p>Você não aceitou nenhuma quest ainda</p>
      @endif
    </li>
</ul>


</div>
</div>
<!-- observatory -->
<div id="observatory" class="uk-modal">
  <div class="uk-modal-dialog uk-modal-dialog-large">
    <a href="" class="uk-modal-close uk-close"></a>
    <div id="starmap" style="width:100%;height:500px;"></div>
    <p><strong>Dica:</strong> Você pode ver mais objetos no céu comprando livros na <a href="#shop" data-uk-modal="{target:'#shop'}"><i class="uk-icon uk-icon-shopping-cart"></i> loja</a>!</p>

  </div>
</div>
<!-- campanha map -->
<div id="campaign" class="uk-modal">
  <div class="uk-modal-dialog">
    <a href="" class="uk-modal-close uk-close"></a>
    @include('game.general.map')
    </div>
</div>
