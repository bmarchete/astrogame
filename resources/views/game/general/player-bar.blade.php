@section('javascript2')
<script>
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
                        UIkit.notify(data.text, {status:'success'});
                   } else {
                        UIkit.notify("<i class='uk-icon-close'></i> " + data.text, {status:'danger'});
                   }    
               } 
           });

        $("#lang-select").change(function(){
            var lang=$(this).val();
            console.log(lang);
            url = '{{ URL('/lang/')}}/' + lang;
            window.location.href = url;
        });
    });

    // music background
    var music_background = new buzz.sound('{{ url('sounds/music/bg.mp3') }}', {preload: true, loop: true});
    music_background.play().loop();
    music_background.setVolume({{ \App\UserConfig::getConfig('music_volume') }});

</script>
@stop
<button class="uk-button uk-button-success button-player-bar" data-uk-toggle="{target:'#player-bar', animation:'uk-animation-slide-bottom'}">Menu do jogador</button>
<button class="uk-button uk-button-danger button-suggestion" data-uk-modal="{target:'#bug-report-modal'}">{{ trans('game.suggestions')}}</button>

<div id="player-bar" class="uk-hidden">
	<div class="uk-grid uk-container uk-container-center uk-text-center uk-margin-top uk-margin-bottom">
		<div class="uk-width-5-10 uk-width-large-2-10">
			<button class="uk-close uk-close-alt" data-uk-toggle="{target:'#player-bar', animation:'uk-animation-slide-bottom'}"></button>
			<a href="#close-bar" class="volume uk-icon-small uk-close-alt uk-icon-cog" data-uk-modal="{target:'#settings'}" data-uk-tooltip title="{{ trans('game.config') }}"></a>
		    <a href="{{ URL('/logout') }}" class="logout uk-icon-small uk-close-alt uk-icon-sign-out" data-uk-tooltip title="{{trans('game.logout')}}"></a>
        </div>

		<div class="uk-width-5-10 uk-width-large-8-10 uk-margin-bottom">
			<div class="uk-progress uk-progress-success">
		    	<div class="uk-progress-bar" style="width: {{ App\User::xp_bar() }}%;" data-uk-tooltip title="{{ App\User::xp_bar() }}% ({{ \Auth::user()->xp }} XP)">faltam 12.0000 pts</div>
			</div>
		</div>	

        <div class="uk-width-1-2 uk-width-large-2-10 uk-margin-top">
            <figure data-uk-modal="{target:'#player-modal'}" class="uk-thumbnail uk-border-circle" style="width: 100px">
                <img src="{{ url('/img/avatar.png') }}" alt="foto avatar" class="uk-border-circle avatar" data-uk-tooltip title="{{ trans('game.astronaut') }} {{ \Auth::user()->name }}">
            </figure>
        </div>

         <div class="uk-width-1-2 uk-width-large-2-10 uk-text-left">
            <ul class="uk-list">
            <li><i class="uk-icon-medium uk-icon-level-up level" data-uk-tooltip title="Nível"></i> {{ \Auth::user()->level }} (aspirante)</li>
            <li><i class="uk-icon-medium uk-icon-money" data-uk-tooltip title="Dinheiro pan-galáctico"></i> DG {{ \Auth::user()->money }}</li>  
            </ul>
        </div>


		<div class="uk-width-large-5-10 uk-hidden-small uk-hidden-medium">
    		<div class="uk-button-group">
    		    <a href="{{ URL('/game/campaign') }}" class="uk-button uk-button-danger"><i class="uk-icon-rocket"></i> {{ trans('game.campaign') }}</a>
    		    <a href="{{ URL('/game/exploration') }}" class="uk-button uk-button-success"><i class="uk-icon-space-shuttle"></i> {{ trans('game.exploration') }}</a>
                <button data-uk-modal="{target:'#calendar'}" class="uk-button"><i class="uk-icon-calendar"></i> {{ trans('game.events') }}</button>
                <a href="{{ URL('/game/observatory')}}" class="uk-button uk-button-primary" @if (\Auth::user()->level < 0) disabled @endif><i class="uk-icon-search"></i> @if (\Auth::user()->level < 0) <span data-uk-tooltip title="Libera no level 6">@endif {{ trans('game.observatory')}} @if (\Auth::user()->level < 0) </span> @endif</a>
                <button data-uk-modal="{target:'#shop'}" class="uk-button uk-button-primary"><i class="uk-icon-shopping-cart"></i> {{ trans('game.shop')}} </button>
                <button class="uk-button uk-button-success"><i class="uk-icon-search-plus"></i> {{ trans('game.quests') }} <span class="uk-badge uk-badge-warning">2</span> </button>
    		</div>
		</div>

        <div class="uk-hidden-large uk-width-1-1 uk-margin-top">
            <div class="uk-button-group">
                <a href="{{ URL('/game/campaign') }}" class="uk-button uk-button-danger"><i class="uk-icon-rocket"></i> {{ trans('game.campaign') }}</a>
                <a href="{{ URL('/game/exploration') }}" class="uk-button uk-button-success"><i class="uk-icon-space-shuttle"></i> {{ trans('game.exploration') }}</a>
            </div>
        </div>


        <div class="uk-hidden-large uk-width-1-1 uk-margin-top">
            <div class="uk-button-group">
                <button data-uk-modal="{target:'#shop'}" class="uk-button uk-button-success"><i class="uk-icon-shopping-cart"></i> Loja </button>
                <a href="{{ URL('/game/observatory')}}" class="uk-button uk-button-primary" @if (\Auth::user()->level < 0) disabled @endif><i class="uk-icon-search"></i> @if (\Auth::user()->level < 0) <span data-uk-tooltip title="Libera no level 6">@endif {{ trans('game.observatory')}} @if (\Auth::user()->level < 0) </span> @endif</a>
            </div>
        </div>

        <div class="uk-hidden-large uk-width-1-1 uk-margin-top">
            <div class="uk-button-group">
                <button class="uk-button"><i class="uk-icon-calendar"></i> Eventos</button>
                <button class="uk-button uk-button-danger"><i class="uk-icon-search-plus"></i> Missões <span class="uk-badge uk-badge-warning">2</span> </button>
            
                
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
                    	<input id="volume-music" type="range" min="0" max="100" value="100"> <i class="uk-icon-music"></i> {{ trans('game.volume-music') }}
                    </label>
                </div>
            </div>

            <div class="uk-form-row">
            	<div class="uk-form-controls">
            			<div class="uk-form-select" data-uk-form-select>
            			    <span>{{ trans('game.lang') }}: </span>
            			    <select id="lang-select" name="lang">
            			        <option value="pt-br" @if (\Session::get('language', 'pt-br') == 'pt-br') selected @endif >Português Brasileiro</option>
            			        <option value="en" @if (\Session::get('language', 'pt-br') == 'en') selected @endif>English</option>
            			    </select>
            			</div>
            	</div>
            </div>

             <div class="uk-form-row">
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
                <button class="uk-button uk-button-danger">{{ trans('game.cancel') }}</button>
            </div>
        </div>
    </div>
</form>

<!-- shop modal -->
<div id="shop" class="uk-modal">
    <div class="uk-modal-dialog">
        <a href="" class="uk-modal-close uk-close"></a>
        <div class="uk-modal-header">
            <h3 class="uk-panel-header">Loja Pan Galáctia</h3>
        </div>
        Vamos as compras?
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
        <div class="uk-modal-header">
            <h3 class="uk-panel-header">Perfil do jogador</h3>
        </div>
        <div class="uk-grid" data-uk-grid>
            <div class="uk-width-2-4">            
                <figure class="uk-thumbnail uk-border-circle" style="width: 200px">
                    <img src="{{ url('/img/avatar.png') }}" alt="foto avatar" class="uk-border-circle avatar" data-uk-tooltip title="{{ trans('game.astronaut') }} {{ \Auth::user()->name }}">
                </figure>
            </div>

            <div class="uk-width-2-4">
                <ul class="uk-list">
                    <li>
                        <i class="uk-icon-medium uk-icon-level-up level" data-uk-tooltip title="Nível"></i> {{ \Auth::user()->level }} (aspirante)</li>
                    <li><i class="uk-icon-medium uk-icon-money" data-uk-tooltip title="Dinheiro pan-galáctico"></i> DG {{ \Auth::user()->money }}</li>  
                </ul>
            </div>
            <a href="{{ URL('/lang/en') }}">English</a>

        </div>
    </div>
</div>
