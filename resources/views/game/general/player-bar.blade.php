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
            music_background.setVolume(volume);
            $.ajax({
              url: '{{ URL('/game/music') }}/' + volume
              // talvez otimizar para não ficar requisitando toda hora para o servidor
            })

        });

        $("#volume-sound").change(function(){
            var volume=$(this).val();
        });

        $(".user-config").ajaxForm({
            type: 'POST',
            dataType: 'JSON',
            success: function(data){
                for (var i = 0; i < data.length; i++) {
                    if (data[i].status){
                        UIkit.notify("<i class='uk-icon-check'></i> " + data[i].text, {status:'success', pos: 'top-right'});
                        if(data[i].avatar){
                            $(".avatar").attr('src', $(".avatar").attr('src') + '?' + Math.random());
                        }
                        $("#old_password").val();
                        $("#new_password").val();
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
<div class="buttons">
    <a href="#profile" class="action-button green menu-jogador" data-uk-modal="{target:'#player-modal'}">Perfil &nbsp;<i class="uk-icon uk-icon-user"></i></a>
    <a href="{{ URL('/game/campaign') }}" class="action-button red menu-campanha">Campanha  <i class="uk-icon uk-icon-map"></i></a>
    <a href="#shop" class="action-button yellow menu-loja" data-uk-modal="{target:'#shop'}">Loja  <i class="uk-icon uk-icon-shopping-cart"></i></a>
    <a href="#missions" class="action-button red menu-missions" data-uk-modal="{target:'#quests'}">Missões &nbsp;&nbsp;<i class="uk-icon uk-icon-exclamation"></i></a>
    <a href="#config" class="action-button red menu-config" data-uk-modal="{target:'#settings'}">Configurações  <i class="uk-icon uk-icon-cog"></i></a>
    <a href="{{ URL('/home') }}" class="action-button green menu-home">Home  <i class="uk-icon uk-icon-home"></i></a>
    <a href="#suggestions" class="action-button red menu-suggestions" data-uk-modal="{target:'#bug-report-modal'}">{{ trans('game.suggestions')}}  <i class="uk-icon uk-icon-mail-forward"></i></a>
    <a href="{{ URL('/logout') }}" class="action-button red menu-logout">Sair  <i class="uk-icon uk-icon-arrow-left"></i></a>
</div>
@include('game.general.modals')
