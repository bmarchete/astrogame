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
                        <input id="volume-sound" type="range" min="0" max="100" value="100"> <i class="uk-icon-volume-up"></i> {{ trans('game.volume-sound') }}
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
            <div class="uk-form-row uk-hidden-touch">
                <div class="uk-form-controls">
                    <label class="uk--label" for="enable-cursos">
                        <input type="checkbox" name="cursor">
                        <i class="uk-icon-mouse-pointer"></i> {{ trans('game.cursor') }}
                    </label>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- bug report modal -->
<form id="bug-report" method="POST" action="{{ URL('/game/report') }}" class="uk-form">
    {!! csrf_field() !!}
    <div id="bug-report-modal" class="uk-modal">
        <div class="uk-modal-dialog">
            <a href="" class="uk-modal-close uk-close"></a>
            <div class="uk-modal-header">
                <h2>{{ trans('game.bug-title') }}</div>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="text">{{ trans('game.bug-message') }}:</label>
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
        <div class="uk-text-right">
            <i class="uk-icon-money"></i> {{ auth()->user()->money }} disponível
        </div>

        <ul class="uk-tab" data-uk-tab="{connect:'#tab-shop'}">
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

<!-- calendar modal -->
<div id="calendar" class="uk-modal">
    <div class="uk-modal-dialog">
        <a href="" class="uk-modal-close uk-close"></a>
        <div class="uk-modal-header">
            <h3 class="uk-panel-header">Calendário Galáctico</h3>
            <div class="uk-datepicker" id="">
   <div class="uk-datepicker-nav">
      <a href="" class="uk-datepicker-previous"></a><a href="" class="uk-datepicker-next"></a>
      <div class="uk-datepicker-heading">
         <span class="uk-form-select">
            March
            <select class="update-picker-month">
               <option value="0">January</option>
               <option value="1">February</option>
               <option value="2" selected="">March</option>
               <option value="3">April</option>
               <option value="4">May</option>
               <option value="5">June</option>
               <option value="6">July</option>
               <option value="7">August</option>
               <option value="8">September</option>
               <option value="9">October</option>
               <option value="10">November</option>
               <option value="11">December</option>
            </select>
         </span>
         <span class="uk-form-select">
            2016
            <select class="update-picker-year">
               <option value="1966">1966</option>
               <option value="1967">1967</option>
               <option value="1968">1968</option>
               <option value="1969">1969</option>
               <option value="1970">1970</option>
               <option value="1971">1971</option>
               <option value="1972">1972</option>
               <option value="1973">1973</option>
               <option value="1974">1974</option>
               <option value="1975">1975</option>
               <option value="1976">1976</option>
               <option value="1977">1977</option>
               <option value="1978">1978</option>
               <option value="1979">1979</option>
               <option value="1980">1980</option>
               <option value="1981">1981</option>
               <option value="1982">1982</option>
               <option value="1983">1983</option>
               <option value="1984">1984</option>
               <option value="1985">1985</option>
               <option value="1986">1986</option>
               <option value="1987">1987</option>
               <option value="1988">1988</option>
               <option value="1989">1989</option>
               <option value="1990">1990</option>
               <option value="1991">1991</option>
               <option value="1992">1992</option>
               <option value="1993">1993</option>
               <option value="1994">1994</option>
               <option value="1995">1995</option>
               <option value="1996">1996</option>
               <option value="1997">1997</option>
               <option value="1998">1998</option>
               <option value="1999">1999</option>
               <option value="2000">2000</option>
               <option value="2001">2001</option>
               <option value="2002">2002</option>
               <option value="2003">2003</option>
               <option value="2004">2004</option>
               <option value="2005">2005</option>
               <option value="2006">2006</option>
               <option value="2007">2007</option>
               <option value="2008">2008</option>
               <option value="2009">2009</option>
               <option value="2010">2010</option>
               <option value="2011">2011</option>
               <option value="2012">2012</option>
               <option value="2013">2013</option>
               <option value="2014">2014</option>
               <option value="2015">2015</option>
               <option value="2016" selected>2016</option>
               <option value="2017">2017</option>
               <option value="2018">2018</option>
               <option value="2019">2019</option>
               <option value="2020">2020</option>
               <option value="2021">2021</option>
               <option value="2022">2022</option>
               <option value="2023">2023</option>
               <option value="2024">2024</option>
               <option value="2025">2025</option>
               <option value="2026">2026</option>
               <option value="2027">2027</option>
               <option value="2028">2028</option>
               <option value="2029">2029</option>
               <option value="2030">2030</option>
               <option value="2031">2031</option>
               <option value="2032">2032</option>
               <option value="2033">2033</option>
               <option value="2034">2034</option>
               <option value="2035">2035</option>
               <option value="2036">2036</option>
            </select>
         </span>
      </div>
   </div>
   <table class="uk-datepicker-table">
      <thead>
         <tr>
            <th>Mon</th>
            <th>Tue</th>
            <th>Wed</th>
            <th>Thu</th>
            <th>Fri</th>
            <th>Sat</th>
            <th>Sun</th>
         </tr>
      </thead>
      <tbody>
         <tr>
            <td><a href="" class="uk-datepicker-table-muted" data-date="2016-02-29T12:00:00-03:00">29</a></td>
            <td><a href="" class="" data-date="2016-03-01T12:00:00-03:00">1</a></td>
            <td><a href="" class="" data-date="2016-03-02T12:00:00-03:00">2</a></td>
            <td><a href="" class="" data-date="2016-03-03T12:00:00-03:00">3</a></td>
            <td><a href="" class="" data-date="2016-03-04T12:00:00-03:00">4</a></td>
            <td><a href="" class="" data-date="2016-03-05T12:00:00-03:00">5</a></td>
            <td><a href="" class="" data-date="2016-03-06T12:00:00-03:00">6</a></td>
         </tr>
         <tr>
            <td><a href="" class="" data-date="2016-03-07T12:00:00-03:00">7</a></td>
            <td><a href="" class="" data-date="2016-03-08T12:00:00-03:00">8</a></td>
            <td><a href="" class="" data-date="2016-03-09T12:00:00-03:00">9</a></td>
            <td><a href="" class="" data-date="2016-03-10T12:00:00-03:00">10</a></td>
            <td><a href="" class="" data-date="2016-03-11T12:00:00-03:00">11</a></td>
            <td><a href="" class="" data-date="2016-03-12T12:00:00-03:00">12</a></td>
            <td><a href="" class="" data-date="2016-03-13T12:00:00-03:00">13</a> (Cometa Halley)</td>
         </tr>
         <tr>
            <td><a href="" class="" data-date="2016-03-14T12:00:00-03:00">14</a></td>
            <td><a href="" class="" data-date="2016-03-15T12:00:00-03:00">15</a></td>
            <td><a href="" class="" data-date="2016-03-16T12:00:00-03:00">16</a></td>
            <td><a href="" class="" data-date="2016-03-17T12:00:00-03:00">17</a></td>
            <td><a href="" class="" data-date="2016-03-18T12:00:00-03:00">18</a></td>
            <td><a href="" class="" data-date="2016-03-19T12:00:00-03:00">19</a></td>
            <td><a href="" class="" data-date="2016-03-20T12:00:00-03:00">20</a></td>
         </tr>
         <tr>
            <td><a href="" class="" data-date="2016-03-21T12:00:00-03:00">21</a></td>
            <td><a href="" class="" data-date="2016-03-22T12:00:00-03:00">22</a></td>
            <td><a href="" class="" data-date="2016-03-23T12:00:00-03:00">23</a></td>
            <td><a href="" class="" data-date="2016-03-24T12:00:00-03:00">24</a></td>
            <td><a href="" class="" data-date="2016-03-25T12:00:00-03:00">25</a></td>
            <td><a href="" class="" data-date="2016-03-26T12:00:00-03:00">26</a></td>
            <td><a href="" class="" data-date="2016-03-27T12:00:00-03:00">27</a></td>
         </tr>
         <tr>
            <td><a href="" class="" data-date="2016-03-28T12:00:00-03:00">28</a></td>
            <td><a href="" class="" data-date="2016-03-29T12:00:00-03:00">29</a></td>
            <td><a href="" class="" data-date="2016-03-30T12:00:00-03:00">30</a></td>
            <td><a href="" class="uk-active" data-date="2016-03-31T12:00:00-03:00">31</a></td>
            <td><a href="" class="uk-datepicker-table-muted" data-date="2016-04-01T12:00:00-03:00">1</a></td>
            <td><a href="" class="uk-datepicker-table-muted" data-date="2016-04-02T12:00:00-03:00">2</a></td>
            <td><a href="" class="uk-datepicker-table-muted" data-date="2016-04-03T12:00:00-03:00">3</a></td>
         </tr>
      </tbody>
   </table>
</div>

        </div>
    </div>
</div>

<!-- insignas details modal -->
@forelse($user_insignas as $insigna)
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
                <p>{{ $insigna->reason }}</p>
            </div>
        </div>

    </div>
</div>
@endforeach

<!-- player modal -->
<div id="player-modal" class="uk-modal">
    <div class="uk-modal-dialog">
        <a href="" class="uk-modal-close uk-close"></a>

        <ul class="uk-tab" data-uk-tab="{connect:'#tab-content'}">
            <li aria-expanded="true" class="uk-active"><a href="#"><i class="uk-icon-user"></i> {{ trans('game.profile') }}</a></li>
            <li class="" aria-expanded="false"><a href="#"><i class="uk-icon-cog"></i> {{ trans('game.account') }}</a></li>
            <li class="" aria-expanded="false"><a href="#"><i class="uk-icon-shopping-bag"></i> {{ trans('game.bag') }}</a></li>
            <li class="" aria-expanded="false"><a href="#"><i class="uk-icon-graduation-cap"></i> {{ trans('game.patents') }}</a></li>
            <li class="" aria-expanded="false"><a href="#"><i class="uk-icon-bookmark"></i> {{ trans('game.insignas') }}</a></li>
        </ul>

<ul id="tab-content" class="uk-switcher uk-margin">
    <li aria-hidden="false" class="uk-active">
        <div class="uk-grid" data-uk-grid>
            <div class="uk-width-2-4">
                <figure class="uk-thumbnail uk-border-circle" style="width: 200px">
                    <img src="{{ url('users/avatar/' . md5(auth()->user()->id) . '.jpg') }}" alt="avatar" class="uk-border-circle avatar" data-uk-tooltip title="{{ $patente }} {{ auth()->user()->name }}">
                </figure>
            </div>
            <div class="uk-width-2-4">
                <ul class="uk-list">
                    <li><i class="uk-icon-medium uk-icon-level-up level" data-uk-tooltip title="{{ trans('game.level') }}"></i> {{ $user_level }} ({{ $patente }})</li>
                    <li><i class="uk-icon-medium uk-icon-money" data-uk-tooltip title="Dinheiro pan-galáctico"></i> DG {{ $user_money }}</li>
                </ul>
                <div class="uk-margin-bottom uk-text-center">
                  XP:
                  <div class="uk-progress">
                      <div class="uk-progress-bar" style="width: {{ $xp_bar }}%;" data-uk-tooltip title="{{ $xp_bar }}% ({{ $user_xp }} XP)">{{ $user_xp }} / {{ $xp_for_next_level }}</div>
                  </div>
              </div>
                <a href="{{ url('/player')}}/{{ auth()->user()->id }}">{{ trans('game.profile-public') }}</a>
            </div>
        </div>
    </li>
  <li aria-hidden="true">
      <div class="uk-grid" data-uk-grid>
          <div class="uk-width-1-1">
              <form method="post" action="{{ url('/game/change_account') }}" class="uk-form user-config" enctype="multipart/form-data">
                  {!! csrf_field() !!}
                  <h3>Básico</h3>
                  <div class="uk-form-row">
                      <label class="uk-form-label" for="text">{{ trans('game.name') }}:</label>
                      <div class="uk-form-controls">
                          <input type="text" name="name" value="{{ auth()->user()->name }}" class="uk-width-1-1">
                      </div>
                  </div>
                  <div class="uk-form-row">
                      <label class="uk-form-label" for="text">{{ trans('game.nickname') }}:</label>
                      <div class="uk-form-controls">
                          <input type="text" name="nickname" value="{{ auth()->user()->nickname }}" class="uk-width-1-1">
                      </div>
                  </div>
                  <div class="uk-form-row">
                      <label class="uk-form-label" for="text">{{ trans('game.email') }}:</label>
                      <div class="uk-form-controls">
                          <input type="email" name="email" value="{{ auth()->user()->email }}" class="uk-width-1-1">
                      </div>
                  </div>
                  <h3>Mudar senha</h3>
                  <div class="uk-form-row">
                      <label class="uk-form-label" for="text">{{ trans('game.old-password') }}:</label>
                      <div class="uk-form-controls">
                          <input type="password" name="old_password" class="uk-width-1-1">
                      </div>
                  </div>
                  <div class="uk-form-row">
                      <label class="uk-form-label" for="text">{{ trans('game.new-password') }}:</label>
                      <div class="uk-form-controls">
                          <input type="password" name="new_password" class="uk-width-1-1">
                      </div>
                  </div>
                  <div class="uk-form-row">
                      <div class="uk-form-controls">
                          <div class="uk-form-file">
                              <button class="uk-button uk-button-danger"><i class="uk-icon uk-icon-photo"></i> {{ trans('game.avatar') }}</button>
                              <input type="file" name="avatar" accept="image/*">
                          </div>
                      </div>
                  </div>
                  <button type="submit" class="uk-button uk-button-success uk-align-right"><i class="uk-icon-check"></i> Salvar alterações</button>
                  @if (!empty(auth()->user()->provider_id) && auth()->user()->provider_id == 1)
                      <button class="uk-button uk-button-success uk-disabled uk-align-right" disabled>
                          <i class="uk-icon-facebook"></i> Vinculado com o Facebook <i class="uk-icon-check"></i>
                      </button>
                  @endif
              </form>
          </div>
      </div>
  </li>
  <li aria-hidden="true">
      <div class="uk-panel uk-panel-box uk-panel-box-primary">
          <h3 class="uk-panel-title"><i class="uk-icon-shopping-bag"> </i> {{ trans('game.bag') }}</h3>
          <ul class="uk-list bag bag-items">
              <li></li>
              @forelse($bag as $item)
              <li onclick="remove_item({{ $item->id }});" class="item-{{ $item->id }}">
                  <span class="uk-badge uk-badge-success">{{ $item->amount }}</span>
                  <figure class="uk-thumbnail">
                      <img src="{{ url('/img/items') }}/{{ $item->img_url }}.png" alt="" data-uk-tooltip title="{{ $item->name }}">
                  </figure>
              </li>
              @empty {{ trans('game.empty-bag') }} @endforelse
          </ul>
      </div>
  </li>
  <li aria-hidden="true">
      <dl class="uk-description-list-line">
          <dt>
              <div class="uk-badge">(0-3)</div> Aspirante
              <div class="uk-text-muted">Observa o espaço à olho nu, de um campo durante a noite</div>
          </dt>
          <dt>
              <div class="uk-badge">(4-6)</div> Observador
              <div class="uk-text-muted">Possui de início uma luneta simples e depois passa a ter um telescópio simples em um pequeno observatório em seu quintal</div>
          </dt>
          <dt>
              <div class="uk-badge">(7-9)</div> Aprendiz
              <div class="uk-text-muted">Atua como um aprendiz em um laboratório modesto dirigido por um dos astrônomos que irão narrar o capítulo</div>
          </dt>
          <dt>
              <div class="uk-badge">(10-12)</div> Doutor
              <div class="uk-text-muted">Possui agora um laboratório bem maior e mais completo</div>
          </dt>
          <dt>
              <div class="uk-badge">(13-14)</div> Comissário
              <div class="uk-text-muted">SEM TEXTO</div>
          </dt>
          <dt>
              <div class="uk-badge">(15)</div> Capitão
              <div class="uk-text-muted">É agora capitão de uma espação espacial</div>
          </dt>
      </dl>
  </li>
  <li aria-hidden="true">
      <ul class="uk-list insignas" style="overflow-y: scroll; height: 300px">
          @forelse($user_insignas as $insigna)
          <li>
              <figure data-uk-modal="{target:'#insigna-{{ $insigna->id }}'}" class="uk-thumbnail uk-border-circle" style="width: 100px">
                  <img src="{{ url('/img/insignias') }}/{{ $insigna->img_url }}.png" alt="" data-uk-tooltip title="{{ $insigna->name }}">
              </figure>
          </li>
          @empty {{ trans('game.empty-insignas') }} @endforelse
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
        @if (!empty($avaliable_quests->first()))
        <div class="uk-grid" data-uk-grid>
            <div class="uk-width-1-3">
                <h3>{{ trans('game.quest-avaliable') }}</h3> @foreach ($avaliable_quests as $quest)
                <div class="uk-hidden" id="quest-title-{{$quest->id}}">{{ $quest->title }}</div>
                <div class="uk-hidden" id="quest-description-{{$quest->id}}">{{ $quest->description }}</div>
                <div class="uk-hidden" id="xp-reward-{{$quest->id}}">{{ $quest->xp_reward }}</div>
                @endforeach
                <select class="uk-form-select quest-avaliable">
                    @foreach ($avaliable_quests as $quest)
                    <option value="{{ $quest->id }}">{{$quest->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="uk-width-2-3 uk-overflow-container">
                <div style="height: 160px; overflow-y: scroll">
                    <h3 class="quest-title">{{ $avaliable_quests->first()->title }}</h3>
                    <p class="quest-description">{{ $avaliable_quests->first()->description }}</p>
                </div>
                <h3>{{ trans('game.quest-reward') }}</h3>
                <div class="uk-grid" data-uk-grid>
                    <div class="uk-width-2-4">
                        <span><i class="uk-icon-money"></i> {{ auth()->user()->money }}</span> /
                        <span><i class="uk-icon-exclamation"></i> <span class="xp-reward">{{ $avaliable_quests->first()->xp_reward }}</span> XP</span>
                    </div>
                    <div class="uk-width-2-4 uk-text-right">
                        <button class="uk-button uk-button-success accept-quest" value="{{ $avaliable_quests->first()->id }}">{{ trans('game.quest-get') }} <i class="uk-icon-exclamation"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif @if (!empty($accepted_quests->first()))
    <div class="uk-grid" data-uk-grid>
        <div class="uk-width-1-3">
            <h3>{{ trans('game.quest-accepted') }}</h3> @foreach ($accepted_quests as $quest)
            <div class="uk-hidden" id="quest-title-{{$quest->id}}">{{ $quest->title }}</div>
            <div class="uk-hidden" id="quest-description-{{$quest->id}}">{{ $quest->description }}</div>
            <div class="uk-hidden" id="xp-reward-{{$quest->id}}">{{ $quest->xp_reward }}</div>
            @endforeach
            <select class="uk-form-select quest-avaliable">
                @foreach ($accepted_quests as $quest)
                <option value="{{ $quest->id }}">{{$quest->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="uk-width-2-3 uk-overflow-container">
            <div style="height: 160px; overflow-y: scroll">
                <h3 class="quest-title">{{ $accepted_quests->first()->title }}</h3>
                <p class="quest-description">{{ $accepted_quests->first()->description }}</p>
            </div>
            <h3>{{ trans('game.quest-reward') }}</h3>
            <div class="uk-grid" data-uk-grid>
                <div class="uk-width-2-4">
                    <span><i class="uk-icon-money"></i> {{ auth()->user()->money }}</span> /
                    <span><i class="uk-icon-exclamation"></i> <span class="xp-reward">{{ $accepted_quests->first()->xp_reward }}</span> XP</span>
                </div>
                <div class="uk-width-2-4 uk-text-right">
                    <button class="uk-button uk-button-danger cancel-quest" value="{{ $accepted_quests->first()->id }}">{{ trans('game.quest-cancel') }} <i class="uk-icon-close"></i></button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
</div>
