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
    var music_background = new buzz.sound('{{ url('sounds/music/ambient.mp3') }}', {preload: true, loop: true});
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

		<div class="uk-width-5-10 uk-width-large-8-10 uk-margin-bottom">
			<div class="uk-progress">
		    	<div class="uk-progress-bar" style="width: {{ $xp_bar }}%;" data-uk-tooltip title="{{ $xp_bar }}% ({{ $user_xp }} XP)">{{ $user_xp }} / {{ $xp_for_next_level }}</div>
			</div>
		</div>	

        <div class="uk-width-1-2 uk-width-large-2-10 uk-margin-top">
            <figure data-uk-modal="{target:'#player-modal'}" class="uk-thumbnail uk-border-circle" style="width: 100px">
                <img src="{{ url('/img/avatar.png') }}" alt="foto avatar" class="uk-border-circle avatar" data-uk-tooltip title="{{ $patente }} {{ $user_name }}">
            </figure>
        </div>

         <div class="uk-width-1-2 uk-width-large-2-10 uk-text-left uk-hidden-small">
            <ul class="uk-list">
            <li><i class="uk-icon-medium uk-icon-level-up level" data-uk-tooltip title="Nível"></i> {{ $user_level }} ({{ $patente }})</li>
            <li><i class="uk-icon-medium uk-icon-money" data-uk-tooltip title="Dinheiro pan-galáctico"></i> DG <span class="money">{{ $user_money }}</span></li>  
            </ul>
        </div>

		<div class="uk-width-large-5-10 uk-hidden-small uk-hidden-medium">
    		<div class="uk-button-group">
    		    <a href="{{ URL('/game/campaign') }}" class="uk-button uk-button-danger"><i class="uk-icon-rocket"></i> {{ trans('game.campaign') }}</a>
    		    <a href="{{ URL('/game/exploration') }}" class="uk-button uk-button-success"><i class="uk-icon-space-shuttle"></i> {{ trans('game.exploration') }}</a>
                <button data-uk-modal="{target:'#calendar'}" class="uk-button"><i class="uk-icon-calendar"></i> {{ trans('game.events') }}</button>
                <a href="{{ URL('/game/observatory')}}" class="uk-button uk-button-primary"><i class="uk-icon-search"></i>{{ trans('game.observatory') }}</a>
                <button data-uk-modal="{target:'#shop'}" class="uk-button uk-button-primary"><i class="uk-icon-shopping-cart"></i> {{ trans('game.shop')}} </button>
                <button data-uk-modal="{target:'#quests'}" class="uk-button uk-button-success"><i class="uk-icon-search-plus"></i> {{ trans('game.quests') }} <span class="uk-badge uk-badge-warning">2</span> </button>
    		</div>
		</div>

        <div class="uk-hidden-large uk-width-1-2 uk-margin-top">
                <a href="{{ URL('/game/campaign') }}" class="uk-button uk-button-danger"><i class="uk-icon-rocket"></i> {{ trans('game.campaign') }}</a>
                <a href="{{ URL('/game/exploration') }}" class="uk-button uk-button-success"><i class="uk-icon-space-shuttle"></i> {{ trans('game.exploration') }}</a>
        
        </div>

        <div class="uk-hidden-large uk-width-1-1 uk-text-center uk-margin-top">
            <div class="uk-button-group">
                <button data-uk-modal="{target:'#shop'}" class="uk-button uk-button-primary"><i class="uk-icon-shopping-cart"></i> {{ trans('game.shop')}} </button>
                <a href="{{ URL('/game/observatory')}}" class="uk-button uk-button-primary"><i class="uk-icon-search"></i>{{ trans('game.observatory') }}</a>
            </div>
        </div>

        <div class="uk-hidden-large uk-width-1-1 uk-text-center">   
        
            <div class="uk-button-group">
                <button data-uk-modal="{target:'#calendar'}" class="uk-button"><i class="uk-icon-calendar"></i> {{ trans('game.events') }}</button>
                <button data-uk-modal="{target:'#quests'}" class="uk-button uk-button-success"><i class="uk-icon-search-plus"></i> {{ trans('game.quests') }} <span class="uk-badge uk-badge-warning">2</span> </button>
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
                    <label class="uk-form-label" for="enable-cursos">
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
    <div id="bug-report-modal" class="uk-modal">
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
                <button type="submit" class="uk-button uk-button-primary">{{ trans('game.submit') }}</button>
                <button class="uk-modal-close uk-button uk-button-danger">{{ trans('game.cancel') }}</button>
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
        </div>
    </div>
</div>

<!-- player modal -->
<div id="player-modal" class="uk-modal">
    <div class="uk-modal-dialog">
        <a href="" class="uk-modal-close uk-close"></a>

        <ul class="uk-tab" data-uk-tab="{connect:'#tab-content'}">
            <li aria-expanded="true" class="uk-active"><a href="#"><i class="uk-icon-user"></i> Perfil</a></li>
            <li class="" aria-expanded="false"><a href="#"><i class="uk-icon-shopping-bag"></i> Mochila</a></li>
            <li class="" aria-expanded="false"><a href="#"><i class="uk-icon-graduation-cap"></i> Patentes</a></li>
        </ul>
        
        <ul id="tab-content" class="uk-switcher uk-margin">
            <li aria-hidden="false" class="uk-active">
                <div class="uk-grid" data-uk-grid>
                <div class="uk-width-2-4">            
                    <figure class="uk-thumbnail uk-border-circle" style="width: 200px">
                        <img src="{{ url('/img/avatar.png') }}" alt="avatar" class="uk-border-circle avatar" data-uk-tooltip title="{{ $patente }} {{ auth()->user()->name }}">
                    </figure>
                </div>

                <div class="uk-width-2-4">
                    <ul class="uk-list">
                        <li>
                            <i class="uk-icon-medium uk-icon-level-up level" data-uk-tooltip title="{{ trans('game.level') }}"></i> {{ $user_level }} ({{ $patente }})</li>
                        <li><i class="uk-icon-medium uk-icon-money" data-uk-tooltip title="Dinheiro pan-galáctico"></i> DG {{ $user_money }}</li>  
                    </ul>
                </div>
                </div>
            </li>

            <li class="" aria-hidden="true">
                <div class="uk-panel uk-panel-box uk-panel-box-primary">
                    <h3 class="uk-panel-title"><i class="uk-icon-shopping-bag"> </i> {{ trans('game.bag') }}</h3>
                    <ul class="uk-list bag bag-items">
                        <li></li>
                        @foreach($bag as $item)
                        <li onclick="remove_item({{ $item->id }});" class="item-{{ $item->id }}">
                            <span class="uk-badge uk-badge-success">{{ $item->amount }}</span>
                            <figure class="uk-thumbnail">
                                <img src="{{ url('/img/items') }}/{{ $item->img_url }}.png" alt="" data-uk-tooltip title="{{ $item->name }}">
                            </figure>
                        </li>   
                        @endforeach
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
        </ul>            
    </div>
</div>

<!-- quests modal -->
<div id="quests" class="uk-modal">
    <div class="uk-modal-dialog uk-modal-dialog-large">
        <a href="" class="uk-modal-close uk-close"></a>
         <div class="uk-modal-header">
            <h3 class="uk-panel-header">{{ trans('game.quests') }} <span class="uk-badge uk-badge-warning">!</span></h3>
        </div>
        <div class="uk-overflow-container">
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