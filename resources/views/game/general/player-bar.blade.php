@section('javascript2')
<script>
function change_xp(xp){
    $(".uk-progress-bar").css('width', xp);
}
    $(document).ready(function(){
        @if (session()->has('notify'))
            @foreach (session()->get('notify') as $notify)
                UIkit.notify({message: '{!! $notify['text'] !!}', status: '{!! $notify['status'] !!}', pos:'top-right'});
            @endforeach
            {{ session()->forget('notify') }}
        @endif

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

        $(".user-config").ajaxForm({
            type: 'POST',
            dataType: 'JSON',
            success: function(data){
                for (var i = 0; i < data.length; i++) {
                    if (data[i].status){
                        UIkit.notify("<i class='uk-icon-check'></i> " + data[i].text, {status:'success', pos: 'top-right'});
                   } else {
                        UIkit.notify("<i class='uk-icon-close'></i> " + data[i].text, {status:'danger', pos: 'top-right'});
                   }  
                };
                 
            }
        });

        $('#bug-report').ajaxForm({
               type: 'POST',
               dataType: 'JSON',
               success: function(data) {
                   if (data.status){
                        var modal = UIkit.modal("#bug-report-modal");
                        modal.hide();
                        UIkit.notify("<i class='uk-icon-check'></i> " + data.text, {status:'success', pos: 'top-right'});
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
            //$(this).prop('disabled', true);
            $.ajax({
                 url: '{{ url('/game/quest_accept')}}/' + quest_id,
                 dataType: "json",
                 success: function(data){
                    if(data.accepted){
                        UIkit.notify("<i class=\"uk-icon-exclamation\"> </i> {{ trans('game.quest-accepted') }}", {status:'success', pos: 'top-right'});
                        quest_effect.play();
                        $(".quest-" + quest_id).insertBefore('.aceitas tr:first').hide().fadeIn(2000);

                    } else {
                        UIkit.notify('<i class=\"uk-icon-close\"> </i> {{ trans('game.quest-already-accepted') }}', {status:'warning', pos: 'top-right'})
                    }
                 }
              });
        });

        

        $(".quest-avaliable").change(function() {
            var id = $(this).val();

            var quest_title = $("#quest-title-" + id).html();
            var quest_description = $("#quest-description-" + id).html();
            var xp_reward = $("#xp-reward-" + id).html();

            $(".quest-title").html(quest_title);
            $(".quest-description").html(quest_description);
            $(".xp-reward").html(xp_reward);
            $(".accept-quest").val(id);
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
                        if(item == 1){ // luneta simples
                            if (typeof buyTutorialHander == 'function'){
                             buyTutorialHander(); 
                            }
                        }

                        if(item == 2){ // guia das estrelas
                            if (typeof buyTutorialLivroHandler == 'function'){
                             buyTutorialLivroHandler(); 
                            }
                        }

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
            <a href="{{ URL('/home') }}" class="logout uk-icon-small uk-close-alt uk-icon-home" data-uk-tooltip title="{{trans('game.home')}}"></a>
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
                <button href="{{ URL('/game/exploration') }}" class="uk-button uk-button-success" title="Recurso não disponível" data-uk-tooltip disabled="true"><i class="uk-icon-space-shuttle"></i> {{ trans('game.exploration') }}</button>
                <button data-uk-modal="{target:'#calendar'}" class="uk-button" title="Quando o cometa Halley passará novamente?" data-uk-tooltip><i class="uk-icon-calendar"></i> {{ trans('game.events') }}</button>
                <a href="{{ URL('/game/observatory')}}" class="uk-button uk-button-primary" title="Hora de observar o céu!" data-uk-tooltip><i class="uk-icon-search"></i> {{ trans('game.observatory') }}</a>
                <button data-uk-modal="{target:'#shop'}" class="uk-button uk-button-danger" title="Vamos gastar um pouco de dinheiro!" data-uk-tooltip><i class="uk-icon-shopping-cart"></i> {{ trans('game.shop')}} </button>
                <button data-uk-modal="{target:'#quests'}" class="uk-button uk-button-success" title="Cada missão uma nova aventura!" data-uk-tooltip><i class="uk-icon-exclamation"></i> {{ trans('game.quests') }} <span class="uk-badge uk-badge-warning">{{ count($avaliable_quests) }}</span> </button>
            </div>
        </div>
        <div class="uk-hidden-large uk-button-dropdown uk-text-left" data-uk-dropdown="{mode:'click'}" aria-haspopup="true" aria-expanded="false">
            <button class="uk-button uk-button-success"><i class="uk-icon-rocket"></i> Navegador <i class="uk-icon-caret-down"></i></button>
            <div class="uk-dropdown uk-dropdown-bottom">
                <ul class="uk-nav uk-nav-dropdown">
                    <li><a href="{{ URL('/game/campaign') }}" title="Cada capítulo uma nova aventura!" data-uk-tooltip><i class="uk-icon-rocket"></i> {{ trans('game.campaign') }}</a></li>
                    <li><a href="{{ URL('/game/exploration') }}" title="Volte todos os dias aqui!" data-uk-tooltip><i class="uk-icon-space-shuttle"></i> {{ trans('game.exploration') }}</a></li>
                    <li class="uk-nav-divider"></li>
                    <li><a href="{{ URL('/game/observatory')}}" title="Hora de observar o céu!" data-uk-tooltip><i class="uk-icon-search"></i> {{ trans('game.observatory') }}</a></li>
                    <li><a href="#" data-uk-modal="{target:'#calendar'}" title="Quando o cometa Halley passará novamente?" data-uk-tooltip><i class="uk-icon-calendar"></i> {{ trans('game.events') }}</a></li>
                    <li class="uk-nav-divider"></li>
                    <li><a href="#" data-uk-modal="{target:'#shop'}" title="Vamos gastar um pouco de dinheiro!" data-uk-tooltip><i class="uk-icon-shopping-cart"></i> {{ trans('game.shop')}} </a></li>
                    <li><a href="#" data-uk-modal="{target:'#quests'}" title="Cada missão uma nova aventura!" data-uk-tooltip><i class="uk-icon-exclamation"></i> {{ trans('game.quests') }} <span class="uk-badge uk-badge-warning">{{ count($avaliable_quests) }}</span> </a></li>
                    <li><a href="{{ url('/ranking') }}"><i class="uk-icon-puzzle-piece"></i> Ranking Geral</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@include('game.general.modals')
