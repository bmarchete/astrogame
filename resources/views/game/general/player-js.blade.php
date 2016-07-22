<script>
function change_xp(xp){
    $(".uk-progress-bar").css('width', xp);
}
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

////////////////////////////////////////////////////
// document ready
///////////////////////////////////////////////////
$(document).ready(function(){
    @if (session()->has('notify'))
        @foreach (session()->get('notify') as $notify)
            UIkit.notify({message: '{!! $notify['text'] !!}', status: '{!! $notify['status'] !!}', pos:'top-right'});
        @endforeach
        {{ session()->forget('notify') }}
    @endif

    $("#volume-music").change(function(){
        var volume=$(this).val();
        background.setVolume(volume);
        $.ajax({
          url: '{{ URL('/game/music') }}/' + volume
          // talvez otimizar para não ficar requisitando toda hora para o servidor
        })

    });

    $("#volume-effects").change(function(){
        var volume=$(this).val();
        sound_effect.setVolume(volume);
        $.ajax({
            url: '{{ URL('/game/effects') }}/' + volume
        })
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



    $("#avatar-file").change(function() {
        var file_avatar = $("#avatar-file")[0].files[0];
        var formData = new FormData();
        formData.append('avatar', file_avatar);

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}'
            }
        });

        $.ajax({
            method: 'POST',
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            url: '{{ url('/game/change_account') }}',
            data: formData,
            success: function(data) {
                if (data[0].status) {
                    UIkit.notify("<i class='uk-icon-check'></i> " + data[0].text, {
                        status: 'success',
                        pos: 'top-right'
                    });
                    if (data[0].avatar) {
                        $(".avatar").attr('src', $(".avatar").attr('src') + '?' + Math.random());
                    }
                } else {
                    UIkit.notify("<i class='uk-icon-close'></i> " + data[0].text, {
                        status: 'danger',
                        pos: 'top-right'
                    });
                }
            }
        });
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
           },
           error: function(data){
                UIkit.notify("<i class='uk-icon-close'></i> " + data.responseJSON.text[0], {status:'danger', pos: 'top-right'});
           }
       });

    $("#lang-select").change(function(){
        var lang=$(this).val();
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

                    if(quest_id > 1) { // ponto pálido
                        window.location = '{{ url('/game/quest') }}' + '/' + quest_id;
                    }

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
        var money_reward = $("#money-reward-" + id).html();

        $(".quest-title").html(quest_title);
        $(".quest-description").html(quest_description);
        $(".xp-reward").html(xp_reward);
        $(".money-reward").html(money_reward);
        $(".accept-quest").val(id);
    });

    var planetarium = $.virtualsky({
            id: 'starmap',
            projection: 'stereo',
            showstars: {{ $planetarium['showstars'] }},
            showstarlabels: {{ $planetarium['showstarlabels'] }},
            constellations: {{ $planetarium['constellations'] }},
            keyboard: false,
            lang: 'pt',
            showdate: {{ $planetarium['showdate'] }},
            showplanets: {{ $planetarium['showplanets'] }},
            showplanetlabels:  {{ $planetarium['showplanetlabels'] }},
            scalestars: 3,
            live: true,
            magnitude: {{ $planetarium['magnitude'] }},
            cardinalpoints: true,
            showposition: false,
            gradient: true,
            ground :true,
            width: 1080,
    });

    $('#starmap').on('dblclick', function(){
        var elem = document.getElementById("starmap");
        if (elem.requestFullscreen) {
          elem.requestFullscreen();
        } else if (elem.msRequestFullscreen) {
          elem.msRequestFullscreen();
        } else if (elem.mozRequestFullScreen) {
          elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullscreen) {
          elem.webkitRequestFullscreen();
        }
    });

    ///////////////////////////////////////////////////
    // logicas de jogo
    ///////////////////////////////////////////////////

});

///////////////////////////////////////////////////
// sons do jogo
///////////////////////////////////////////////////
$(".action-button").click(function(){
    map_effect.play();
});

// music background
var music_background = new buzz.sound('{{ url('sounds/music/bg.mp3') }}', {preload: true, loop: false});
var music_background2 = new buzz.sound('{{ url('sounds/music/bg2.mp3') }}', {preload: true, loop: false});

var coin_effect = new buzz.sound('{{ url('/sounds/effects/inventory/coin.mp3')}}', {preload: true, loop: false});
var delete_effect = new buzz.sound('{{ url('/sounds/effects/inventory/delete_item.mp3')}}', {preload: true, loop: false});
var quest_effect = new buzz.sound('{{ url('/sounds/effects/quest_effect.mp3') }}', {preload: true, loop: false});
var map_effect = new buzz.sound('{{ url('/sounds/effects/map_open.mp3')}}', {preload: true, loop:false});

var sound_effect = new buzz.group([
      coin_effect,
      delete_effect,
      quest_effect,
      map_effect
]);

var background = new buzz.group([
    music_background, music_background2
]);

// starts the background music
music_background.play();
music_background.bind("ended", function(){
    // when ended starts the second
    music_background2.play();
});

music_background2.bind("ended", function(){
    music_background.play();
});

background.setVolume({{ $music_volume }});
sound_effect.setVolume({{ $effects_volume }});

</script>
