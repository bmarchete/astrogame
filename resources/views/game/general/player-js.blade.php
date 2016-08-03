<script>
function change_xp(xp){
    $(".uk-progress-bar").css('width', xp);
}
function buy_item(item){
    UIkit.modal.confirm("{{ trans('game.buy-item') }}", function(){
            formData = new FormData();
            formData.append('id', item);
            $.ajax({
             url: '{{ url('/game/buy_item')}}',
             dataType: 'json',
             method: 'POST',
             processData: false,
             contentType: false,
             data: formData,
             success: function(data){
                if(data.status_or_price == false){
                    UIkit.notify('<i class="uk-icon-close"> </i> ' + data.msg, {status:'danger', pos: 'top-right'});
                } else {
                    UIkit.notify('<i class="uk-icon-check"> </i> ' + data.msg, {status:'success', pos: 'top-right'});
                    coin_effect.play();

                    var money_player = parseInt($('.money').html());
                    var money_final = money_player - data.status_or_price;
                    $('.money').html(money_final);

                    $(data.html).insertBefore(".bag-items li:first").hide().fadeIn(2000);
                }
             },
             error: function(data){
                for (var i = 0; i < data.responseJSON.id.length; i++) {
                    UIkit.notify(data.responseJSON.id[i], {status: 'danger', pos:'top-right'});
                }
             }
          });
    });
}

function remove_item(item){
    UIkit.modal.confirm("{{ trans('game.remove-item') }}", function(){
            formData = new FormData();
            formData.append('id', item);

            $.ajax({
             url: '{{ url('/game/remove_item')}}',
             dataType: 'json',
             method: 'POST',
             processData: false,
             contentType: false,
             data: formData,
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
function startIntro(){
        var intro = introJs();
          intro.setOptions({
            'showBullets': false,
            'nextLabel': 'Próximo',
            'prevLabel': 'Anterior',
            'skipLabel': 'Sair do Tutorial',
            'doneLabel': 'OK entendi :)',
            steps: [
              {
                intro: "Bem vindo, nesse jogo você poderá aprender o básico sobre astronomia, mas antes vamos te guiar pelo jogo e mostrar o que você pode fazer nele!"
              },

              {
                intro: "Acesso para <i class='uk-icon-user'></i> perfil, <i class='uk-icon-cog'></i> configurar sua conta, visualizar a quantidade de dinheiro diponível, patentes,  <i class='uk-icon-shopping-bag'></i> mochila e ranking!",
                element: document.querySelector('.menu-jogador'),
                position: 'right'
              },

              {
                intro: "Aqui você pode ver qual capítulo você está e quais faltam completar",
                element: document.querySelector('.menu-campanha'),
                position: 'right'
              },

              {
                intro: "Aqui você aceitar e realizar missões para ganhar mais <i class='uk-icon uk-icon-exclamation'></i> XP e <i class='uk-icon uk-icon-money'></i> dinheiro",
                element: document.querySelector('.menu-missions'),
                position: 'right'
              },

              {
                intro: "Aqui você comprar itens com dinheiro adquirido nos capítulos e missões",
                element: document.querySelector('.menu-loja'),
                position: 'right'
              },

              {
                intro: "Você pode visualizar as estrelas aqui",
                element: document.querySelector('.menu-observatory'),
                position: 'right'
              },

              {
                intro: "Aqui você pode alterar o volume do som do jogo e idiomas",
                element: document.querySelector('.menu-config'),
                position: 'right'
              },

              {
                intro: "Você pode nos enviar sugestões de novas fases, ideias de jogos, melhorias, erros que estão acontecendo no jogo, críticas, e qualquer outra ideia que vier a sua mente.",
                element: document.querySelector('.menu-suggestions'),
                position: 'right'
              },

              {
                intro: "Para começar a jogar clique aqui!",
                element: document.querySelector('#big-bang'),
                position: 'top'
              },

            ]
          });

          intro.start();


      }

////////////////////////////////////////////////////
// document ready
///////////////////////////////////////////////////
$(document).ready(function(){
    startIntro();

    introJs().oncomplete(function() {
      alert("exit of introduction");
      console.log('doasidjsaoidaso');
    });

    @if (!session()->has('orientation'))
      if(window.innerHeight > window.innerWidth){
          UIkit.notify({message: '<i class="uk-icon-exclamation"></i> Recomendamos utilizar o modo <strong>paisagem</strong> para melhor visualização', status: 'warning', pos:'top-right'});
          {{ session(['orientation' => true]) }}
      }
    @endif

    @if (session()->has('notify'))
        @foreach (session()->get('notify') as $notify)
            UIkit.notify({message: '{!! $notify['text'] !!}', status: '{!! $notify['status'] !!}', pos:'top-right'});
        @endforeach
        {{ session()->forget('notify') }}
    @endif

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}'
        }
    });

    $("#volume-music").change(function(){
        var volume=$(this).val();
        background.setVolume(volume);
        UIkit.notify("<i class='uk-icon-music'></i> Alterando volume, aguarde.", {status:'warning', pos: 'top-right'});
        $.ajax({
          url: '{{ URL('/game/music') }}/' + volume,
          success: function(){
              UIkit.notify("<i class='uk-icon-music'></i> Música alterada para " + volume + "%", {status:'success', pos: 'top-right'});
          }
          // talvez otimizar para não ficar requisitando toda hora para o servidor
        })

    });

    $("#volume-effects").change(function(){
        var volume=$(this).val();
        sound_effect.setVolume(volume);
        UIkit.notify("<i class='uk-icon-volume-up'></i> Alterando volume, aguarde.", {status:'warning', pos: 'top-right'});
        $.ajax({
            url: '{{ URL('/game/effects') }}/' + volume,
            success: function(){
                UIkit.notify("<i class='uk-icon-volume-up'></i> Volume dos efeitos sonoros alterado para " + volume + "%", {status:'success', pos: 'top-right'});
            }
        })
    });

    $("#private").click(function(){
        $.ajax({
          url: '{{ URL('/game/profile/private') }}',
          success: function(){
              UIkit.notify("<i class='uk-icon-user-secret'></i> Perfil alterado para privado", {status:'success', pos: 'top-right'});
          }
        });
    });

    $("#public").click(function(){
        $.ajax({
          url: '{{ URL('/game/profile/public') }}',
          success: function(){
              UIkit.notify("<i class='uk-icon-globe'></i> Perfil alterado para público", {status:'success', pos: 'top-right'});
          }
        });
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
        UIkit.notify("<i class='uk-icon-exclamation'></i> Enviando avatar, aguarde um pouco :)", {status:'warning', pos: 'top-right'});

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
