@section('javascript2')
<script>
function change_xp(xp){
    $(".uk-progress-bar").css('width', xp);
}
    $(document).ready(function(){
        $("#volume-music").change(function(){
            var volume=$(this).val();
            console.log("Music volume set to: " + volume + "%");
            music_background.setVolume(volume);
            $.ajax({
              url: '{{ URL('/game/music') }}/' + volume 
              // talvez otimizar para não ficar requisitando toda hora para o servidor
            })

        });

        $("#volume-sound").change(function(){
            var volume=$(this).val();
            console.log("Sound effects volume set to: " + volume + "%");
        });


        $('#bug-report').ajaxForm({
               type: "POST",
               dataType: 'JSON',
               success: function(data) {
                   if (data.status){
                        var modal = UIkit.modal("#bug-report-modal");
                        modal.hide();
                        UIkit.notify(data.text, {status:'success', pos: 'top-right'});
                   } else {
                        UIkit.notify("<i class='uk-icon-close'></i> " + data.text, {status:'danger', pos: 'top-right'});
                   }    
               } 
           });

        $("#lang-select").change(function(){
            var lang=$(this).val();
            console.log(lang);
            url = '{{ URL('/lang/')}}/' + lang;
            window.location.href = url;
        });


        // quest accept
        $(".accept-quest").click(function(){
            var quest_id = $(this).val();
            $(this).prop('disabled', true);
            $.ajax({
                 url: '{{ url('/game/quest_accept')}}/' + quest_id,
                 dataType: "json",
                 success: function(data){
                    if(data.accepted){
                        UIkit.notify("<i class=\"uk-icon-exclamation\"> </i> {{ trans('game.quest-accepted') }}", {status:'success', pos: 'top-right'});
                        quest_effect.play();
                        $(".quest-" + quest_id).insertBefore('.aceitas tr:first').hide().fadeIn(2000);

                    } else {
                        UIkit.notify('{{ trans('game.quest-already-accepted') }}', {status:'warning', pos: 'top-right'})
                    }
                 }
              });
        });

        $(".quest-avaliable").change(function() {
            var id = $(this).val();

            var quest_text = $("quest-title-" + id).html();
            var quest_description = $("quest-description-" + id).html();
            var quest_recompensas = $("quest-recompensas-" + id).html();
            
            console.log(quest_text);
            console.log(quest_description);
            console.log(quest_recompensas);

            $(".quest-text").html(quest_text);
        });


    });

    function buy_item(item){
        UIkit.modal.confirm("{{ trans('game.buy-item') }}", function(){
                $.ajax({
                 url: '{{ url('/game/buy_item')}}/' + item,
                 dataType: "json",
                 success: function(data){
                    if(data.status_or_price == false){
                        UIkit.notify('<i class="uk-icon-close"> </i> ' + data.msg, {status:'danger', pos: 'top-right'});
                    } else {
                        UIkit.notify('<i class="uk-icon-check"> </i> ' + data.msg, {status:'success', pos: 'top-right'});
                        coin_effect.play();

                        var money_player = parseInt($('.money').html());
                        var money_final = money_player - data.status_or_price;
                        $('.money').html(money_final);
                        $('.money').addClass('uk-animation-scale-down');


                        $(data.html).insertBefore(".bag-items li:first").hide().fadeIn(2000);
                    }
                 }
              });

        });
    }

    function remove_item(item){
        UIkit.modal.confirm("{{ trans('game.remove-item') }}", function(){
                $.ajax({
                 url: '{{ url('/game/remove_item')}}/' + item,
                 dataType: "json",
                 success: function(data){ //Se ocorrer tudo certo
                    if(data.status == false){
                        UIkit.notify(data.msg, {status:'danger', pos: 'top-right'});
                    } else {
                        $(".item-" + item).hide();
                        delete_effect.play();
                        UIkit.notify(data.msg, {status:'warning', pos: 'top-right'});
                    }
                 }
              });

        });

    }

    // music background
    var music_background = new buzz.sound('{{ url('sounds/music/bg.mp3') }}', {preload: true, loop: true});
    var coin_effect = new buzz.sound('{{ url('/sounds/effects/inventory/coin.mp3')}}', {preload: true, loop: false});
    var delete_effect = new buzz.sound('{{ url('/sounds/effects/inventory/delete_item.mp3')}}', {preload: true, loop: false});
    var quest_effect = new buzz.sound('{{ url('/sounds/effects/quest_effect.mp3') }}', {preload: true, loop: false})

    music_background.play().loop();
    music_background.setVolume({{ $music_volume }});

</script>
@stop
<button class="uk-button uk-button-success button-player-bar" data-uk-toggle="{target:'#player-bar', animation:'uk-animation-slide-bottom'}">{{ trans('game.player-bar') }}</button>
<button class="uk-button uk-button-danger button-suggestion" data-uk-modal="{target:'#bug-report-modal'}">{{ trans('game.suggestions')}}</button>

<div id="player-bar" class="uk-hidden">
	<div class="uk-grid uk-container uk-container-center uk-text-center uk-margin-top uk-margin-bottom">
		<div class="uk-width-5-10 uk-width-large-2-10">
			<button class="uk-close uk-close-alt" data-uk-toggle="{target:'#player-bar', animation:'uk-animation-slide-bottom'}"></button>
			<a href="#close-bar" class="volume uk-icon-small uk-close-alt uk-icon-cog" data-uk-modal="{target:'#settings'}" data-uk-tooltip title="{{ trans('game.config') }}"></a>
		    <a href="{{ URL('/logout') }}" class="logout uk-icon-small uk-close-alt uk-icon-sign-out" data-uk-tooltip title="{{trans('game.logout')}}"></a>
        </div>

		<div class="uk-width-5-10 uk-width-large-8-10 uk-margin-bottom uk-text-center">
			<div class="uk-progress">
		    	<div class="uk-progress-bar" style="width: {{ $xp_bar }}%;" data-uk-tooltip title="{{ $xp_bar }}% ({{ $user_xp }} XP)">{{ $user_xp }} / {{ $xp_for_next_level }}</div>
			</div>
		</div>	

        <div class="uk-width-1-2 uk-width-large-2-10 uk-margin-top">
            <figure data-uk-modal="{target:'#player-modal'}" class="uk-thumbnail uk-border-circle" style="width: 100px">
                <img src="{{ url('users/avatar/' . md5(auth()->user()->id) . '.jpg') }}" alt="foto avatar" class="uk-border-circle avatar" data-uk-tooltip title="{{ $patente }} {{ $user_name }}">
            </figure>
        </div>

         <div class="uk-width-1-2 uk-width-large-2-10 uk-text-left uk-hidden-small">
            <ul class="uk-list">
            <li><i class="uk-icon-medium uk-icon-level-up level" data-uk-tooltip title="{{ trans('game.level') }}"></i> {{ $user_level }} ({{ $patente }})</li>
            <li><i class="uk-icon-medium uk-icon-money" data-uk-tooltip title="Dinheiro pan-galáctico"></i> DG <span class="money">{{ $user_money }}</span></li>  
            </ul>
        </div>

		<div class="uk-width-large-5-10 uk-hidden-small uk-hidden-medium">
    		<div class="uk-button-group">
    		    <a href="{{ URL('/game/campaign') }}" class="uk-button uk-button-danger" title="Cada capítulo uma nova aventura!" data-uk-tooltip><i class="uk-icon-rocket"></i> {{ trans('game.campaign') }}</a>
    		    <a href="{{ URL('/game/exploration') }}" class="uk-button uk-button-success" title="Volte todos os dias aqui!" data-uk-tooltip><i class="uk-icon-space-shuttle"></i> {{ trans('game.exploration') }}</a>
                <button data-uk-modal="{target:'#calendar'}" class="uk-button" title="Quando o cometa Halley passará novamente?" data-uk-tooltip><i class="uk-icon-calendar"></i> {{ trans('game.events') }}</button>
                <a href="{{ URL('/game/observatory')}}" class="uk-button uk-button-primary" title="Hora de observar o céu!" data-uk-tooltip><i class="uk-icon-search"></i> {{ trans('game.observatory') }}</a>
                <button data-uk-modal="{target:'#shop'}" class="uk-button uk-button-danger" title="Vamos gastar um pouco de dinheiro!" data-uk-tooltip><i class="uk-icon-shopping-cart"></i> {{ trans('game.shop')}} </button>
                <button data-uk-modal="{target:'#quests'}" class="uk-button uk-button-success" title="Cada missão uma nova aventura!" data-uk-tooltip><i class="uk-icon-exclamation"></i> {{ trans('game.quests') }} <span class="uk-badge uk-badge-warning">{{ count($avaliable_quests) }}</span> </button>
    		</div>
		</div>

        <div class="uk-hidden-large uk-button-dropdown uk-text-left" data-uk-dropdown="{mode:'click'}" aria-haspopup="true" aria-expanded="false">
            <button class="uk-button uk-button-success"><i class="uk-icon-rocket"></i> Navegador <i class="uk-icon-caret-down"></i></button>
            <div class="uk-dropdown uk-dropdown-bottom" style="top: 30px; left: 0px;">
                <ul class="uk-nav uk-nav-dropdown">
                    <li><a href="{{ URL('/game/campaign') }}" title="Cada capítulo uma nova aventura!" data-uk-tooltip><i class="uk-icon-rocket"></i> {{ trans('game.campaign') }}</a></li>
                    <li><a href="{{ URL('/game/exploration') }}" title="Volte todos os dias aqui!" data-uk-tooltip><i class="uk-icon-space-shuttle"></i> {{ trans('game.exploration') }}</a></li>
                    <li class="uk-nav-divider"></li>
                    <li><a href="{{ URL('/game/observatory')}}" title="Hora de observar o céu!" data-uk-tooltip><i class="uk-icon-search"></i> {{ trans('game.observatory') }}</a></li>
                    <li><a href="#" data-uk-modal="{target:'#calendar'}" title="Quando o cometa Halley passará novamente?" data-uk-tooltip><i class="uk-icon-calendar"></i> {{ trans('game.events') }}</a></li>
                    <li class="uk-nav-divider"></li>
                    <li><a href="#" data-uk-modal="{target:'#shop'}" title="Vamos gastar um pouco de dinheiro!" data-uk-tooltip><i class="uk-icon-shopping-cart"></i> {{ trans('game.shop')}} </a></li>
                    <li><a href="#"  data-uk-modal="{target:'#quests'}" title="Cada missão uma nova aventura!" data-uk-tooltip><i class="uk-icon-exclamation"></i> {{ trans('game.quests') }} <span class="uk-badge uk-badge-warning">{{ count($avaliable_quests) }}</span> </a></li>
                    <li><a href="{{ url('/ranking') }}"><i class="uk-icon-puzzle-piece"></i> Ranking Geral</a></li>
                    <!-- <li class="uk-nav-header">Header</li> -->
                </ul>
            </div>
        </div>
	</div>
</div>

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
            			    <span>{{ trans('game.lang') }}: </span>
            			    <select id="lang-select" name="lang">
            			        <option value="pt-br" @if ($lang == 'pt-br') selected @endif >Português Brasileiro</option>
            			        <option value="en" @if ($lang == 'en') selected @endif>English</option>
                                <option value="es" @if ($lang == 'es') selected @endif>Español</option>
                                <option value="fr" @if ($lang == 'fr') selected @endif>Français</option>
            			    </select>
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
<form id="bug-report" method="POST" action="{{ URL('/bug') }}" class="uk-form">
{!! csrf_field() !!}
    <div id="bug-report-mformodal" class="uk-modal">
        <div class="uk-modal-dialog">
            <a href="" class="uk-modal-close uk-close"></a>
            <div class="uk-modal-header"><h2>{{ trans('game.bug-title') }}</div>
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
        <p>{{ trans('game.shop-slogan') }}</p>

        <div class="uk-width-1-1">
            <ul class="uk-list bag">
            @foreach($shop as $item)
                <li>
                    @if ($item->max_stack > 1)
                    <span class="uk-badge uk-badge-danger" title="{{ trans('game.item-max') }}" data-uk-tooltip>{{ $item->max_stack }}</span>
                    @endif    
                        <figure class="uk-thumbnail uk-text-center buy-item" onclick="buy_item({{ $item->id }});">
                            <img src="{{ url('/img/items') }}/{{ $item->img_url }}.png" alt="" title="{{ $item->name }}" data-uk-tooltip >
                        <figcaption class="uk-align-center uk-text-center">
                            <span class="price"><i class="uk-icon-money"></i> {{ $item->price }}</span>
                        </figcaption>
                </li>
            @endforeach
            </ul>
        </div>

        <ul class="uk-pagination">
            <li><a href="">1</a></li>
            <li class="uk-active"><span>2</span></li>
            <li><a href="">3</a></li>
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
                    <a href="{{ url('/player')}}/{{ auth()->user()->id }}">{{ trans('game.profile-public') }}</a>
                </div>
                </div>
            </li>

            <li class="" aria-hidden="true">
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
                        @empty
                        Sua mochila está vazia :(
                        @endforelse
                    </ul>
                </div>
            </li>
            <li class="" aria-hidden="true">
                <dl class="uk-description-list-line">
                    <dt><div class="uk-badge">(0-3)</div> {{ trans('game.patent1')}}</dt>
                    <dt><div class="uk-badge">(3-6)</div> {{ trans('game.patent2')}}</dt>
                    <dt><div class="uk-badge">(6-9)</div> {{ trans('game.patent3')}}</dt>
                    <dt><div class="uk-badge">(9-10)</div> {{ trans('game.patent4')}}</dt>
                    <dt><div class="uk-badge">(10-11)</div> {{ trans('game.patent5')}}</dt>
                    <dt><div class="uk-badge">(12)</div> {{ trans('game.patent6')}}</dt>
                    <dt><div class="uk-badge">(13)</div> {{ trans('game.patent7')}}</dt>
                    <dt><div class="uk-badge">(14)</div> {{ trans('game.patent8')}}</dt>
                    <dt><div class="uk-badge">(15)</div> {{ trans('game.patent9')}}</dt>
                </dl>
            </li>
            <li class="" aria-hidden="true">
                <ul class="uk-list insignas">
                    @forelse($user_insignas as $insigna)
                    <li>
                        <figure data-uk-modal="{target:'#insigna-{{ $insigna->id }}'}" class="uk-thumbnail uk-border-circle" style="width: 100px">
                            <img src="{{ url('/img/insignias') }}/{{ $insigna->img_url }}.png" alt="" data-uk-tooltip title="{{ $insigna->name }}">
                        </figure>
                    </li>
                    
                    @empty
                    Você não tem nenhuma insigna ainda :(
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

        
        <div class="uk-grid" data-uk-grid>
            <div class="uk-width-1-3">
                <h3>{{ trans('game.quest-avaliable') }}</h3>
                @foreach ($avaliable_quests as $quest)
                 <div class="uk-hidden" id="quest-title-{{$quest->id}}">{{ $quest->title }}</div>
                    <div class="uk-hidden" id="quest-description-{{$quest->id}}">{{ $quest->description }}</div>
                    <div class="uk-hidden" id="quest-recompensas-{{$quest->id}}">{{ $quest->recompensas }}</div>
                @endforeach

                <select class="uk-form-select quest-avaliable"> 
                    @foreach ($avaliable_quests as $quest)

                    <option value="{{ $quest->id }}">{{$quest->title}}</option>
                    
                   
                    @endforeach
                    <option value="3">Teste</option>
                </select>
            </div>

            <div class="uk-width-2-3 uk-overflow-container">
                <div style="height: 160px; overflow: scroll">
                <h3 class="quest-title">Quest Title</h3>
                <p class="quest-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                </div>

                <h3>Recompensas</h3>

                <span><i class="uk-icon-money"> </i> {{ auth()->user()->money }}</span> / 
                <span><i class="uk-icon-exclamation"> </i> 1000 XP</span>

                <br>

                <button class="uk-button uk-button-danger">Aceitar missão</button>
                
            </div>    
        </div>

        <div class="uk-overflow-container uk-hidden">
        <table class="uk-table">
            <caption>{{ trans('game.quest-avaliable') }}</caption>
            <thead>
                <tr>
                    <th>{{ trans('game.quest-title') }}</th>
                    <th>{{ trans('game.quest-type') }}</th>
                    <th>{{ trans('game.quest-description') }}</th>
                    <th>{{ trans('game.quest-goal') }}</th>
                    <th>{{ trans('game.quest-reward') }}</th>
                    <th>{{ trans('game.quest-level-min') }}</th>
                    <th>{{ trans('game.quest-level-max') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($avaliable_quests as $quest)
                <tr class="quest-{{ $quest->id }}">
                    <td>{{ $quest->title }}</td>
                    <td>{{ $quest->type }}</td>
                    <td>{{ $quest->description }}</td>
                    <td>{{ $quest->objetivos }}</td>
                    <td>{{ $quest->recompensas }}</td>
                    <td>{{ $quest->min_level }}</td>
                    <td>{{ $quest->max_level }}</td>
                    <td><button class="uk-button uk-button-success accept-quest" value="{{ $quest->id }}">{{ trans('game.quest-get') }}</button>
                </tr>
                @endforeach
            </tbody>
        </table>

        <table class="uk-table">
            <caption>{{ trans('game.quest-accept') }}</caption>
            <thead>
                <tr>
                    <th>{{ trans('game.quest-title') }}</th>
                    <th>{{ trans('game.quest-type') }}</th>
                    <th>{{ trans('game.quest-description') }}</th>
                    <th>{{ trans('game.quest-goal') }}</th>
                    <th>{{ trans('game.quest-reward') }}</th>
                    <th>{{ trans('game.quest-level-min') }}</th>
                    <th>{{ trans('game.quest-level-max') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="aceitas">
                <tr></tr>
                @foreach ($accepted_quests as $quest)
                <tr>
                    <td>{{ $quest->title }}</td>
                    <td>{{ $quest->type }}</td>
                    <td>{{ $quest->description }}</td>
                    <td>{{ $quest->objetivos }}</td>
                    <td>{{ $quest->recompensas }}</td>
                    <td>{{ $quest->min_level }}</td>
                    <td>{{ $quest->max_level }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>