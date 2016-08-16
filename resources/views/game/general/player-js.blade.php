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
          intro: '{{ trans('tutorial.tuto1')}}'
        },

        {
          intro: '{{ trans('tutorial.tuto2')}}',
          element: document.querySelector('.menu-jogador'),
          position: 'right'
        },

        {
          intro: '{{ trans('tutorial.tuto3')}}',
          element: document.querySelector('.menu-campanha'),
          position: 'right'
        },

        {
          intro: '{{ trans('tutorial.tuto4')}}',
          element: document.querySelector('.menu-missions'),
          position: 'right'
        },

        {
          intro: '{{ trans('tutorial.tuto5')}}',
          element: document.querySelector('.menu-loja'),
          position: 'right'
        },

        {
          intro: '{{ trans('tutorial.tuto6')}}',
          element: document.querySelector('.menu-observatory'),
          position: 'right'
        },

        {
          intro: '{{ trans('tutorial.tuto7')}}',
          element: document.querySelector('.menu-config'),
          position: 'right'
        },

        {
          intro: '{{ trans('tutorial.tuto8')}}',
          element: document.querySelector('.menu-suggestions'),
          position: 'right'
        },

        {
          intro: '{{ trans('tutorial.tuto9')}}',
          element: document.querySelector('.menu-home'),
          position: 'right'
        },

        {
          intro: '{{ trans('tutorial.tuto10')}}',
          element: document.querySelector('.menu-logout'),
          position: 'right'
        },

        {
          intro: '{{ trans('tutorial.tuto11')}}',
          element: document.querySelector('#big-bang'),
          position: 'top'
        },

      ]
    });

    intro.start().onexit(function(){
      complete_tutorial();
    }).oncomplete(function(){
      complete_tutorial();
    });
}

function complete_tutorial(){
      tutorial('done');
      $('#tutorial-done').hide();
      $('#tutorial-again').show();
}

function tutorial(done_or_again){
    $.ajax({
        url: '{{ url('/game/tutorial') . '/' }}' + done_or_again,
        success: function(data){
            UIkit.notify("<i class='uk-icon-exclamation'></i> " + data.text, {status:data.status, pos: 'top-right'});
        }
    });
}

var completed_quest = false;
function complete_quest(quest_name){
    if(window.completed_quest == false){
      var formData = new FormData();
      formData.append('name', quest_name);

      $.ajax({
           url: '{{ url('/game/quest_complete')}}',
           dataType: 'json',
           type: 'POST',
           processData: false,
           contentType: false,
           data: formData,
           success: function(data){
              if(data.status){
                  UIkit.notify('<i class="uk-icon-exclamation"></i> Missão completada', {status: 'success', pos:'top-right'});

                  quest_effect.play();
                  setTimeout(function(){
                      window.location = '{{ url('/game') }}';
                  }, 1000);
              } else {
                  UIkit.notify('<i class="uk-icon-exclamation"></i> ' + data.text, {status: 'danger', pos:'top-right'});
              }
           },
           error: function(data){
              for (var i = 0; i < data.responseJSON.id.length; i++) {
                  UIkit.notify(data.responseJSON.id[i], {status: 'danger', pos:'top-right'});
              }
           }
        });
      }

      completed_quest = true;
}

////////////////////////////////////////////////////
// document ready
///////////////////////////////////////////////////
$(document).ready(function(){

    @if ($tutorial)
      startIntro();
    @endif

    $('#tutorial-done').click(function(){
      $(this).hide();
      $('#tutorial-again').show();
      tutorial('done');
    });

    $('#tutorial-again').click(function(){
        $(this).hide();
        $('#tutorial-done').show();
        tutorial('again');
        UIkit.modal("#settings").hide();
        startIntro();
    });

    @if (!session()->has('orientation'))
      if(window.innerHeight > window.innerWidth){
          UIkit.notify({message: '<i class="uk-icon-exclamation"></i> Recomendamos utilizar o modo <strong>paisagem</strong> para melhor visualização', status: 'warning', pos:'top-right'});
          {{ session(['orientation' => true]) }}
      }
    @endif

    @if (session()->has('notify'))
        @foreach (session()->get('notify') as $notify)
            UIkit.notify({message: '{!! $notify['text'] !!}', status: '{!! $notify['status'] !!}', pos:'top-right', timeout: {{ $notify['timeout']}}});
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
                        $(".avatar").attr('src', data[i].avatar + '?' + Math.random());
                    }
                    $("#old_password").val();
                    $("#new_password").val();
               } else {
                    UIkit.notify("<i class='uk-icon-close'></i> " + data[i].text, {status:'danger', pos: 'top-right'});
               }
            };

        }
    });

    $("#remove-avatar").click(function(){
        $.ajax({
            url: '{{ url('/game/remove_avatar')}}',
            dataType: 'JSON',
            success: function(data){
                UIkit.notify({message: data.text, status: data.status, pos: 'top-right'});
                $(".avatar").attr('src', data.avatar + '?' + Math.random());
            }
        });
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
                        $(".avatar").attr('src', data[0].avatar + '?' + Math.random());
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
        var quest_name = $('#quest-name-' + quest_id).html();
        var formData = new FormData();
        formData.append('id', quest_id);

        $.ajax({
             url: '{{ url('/game/quest_accept')}}',
             dataType: 'json',
             type: 'POST',
             processData: false,
             contentType: false,
             data: formData,
             success: function(data){
                if(data.accepted){
                    UIkit.notify("<i class=\"uk-icon-exclamation\"> </i> {{ trans('game.quest-accepted') }}", {status:'success', pos: 'top-right'});
                    quest_effect.play();
                    $(".quest-" + quest_id).insertBefore('.aceitas tr:first').hide().fadeIn(2000);
                    window.location = '{{ url('/game/quest') }}' + '/' + quest_name;


                } else {
                    UIkit.notify('<i class=\"uk-icon-close\"> </i> {{ trans('game.quest-already-accepted') }}', {status:'warning', pos: 'top-right'})
                }
             },
             error: function(data){
                for (var i = 0; i < data.responseJSON.id.length; i++) {
                    UIkit.notify(data.responseJSON.id[i], {status: 'danger', pos:'top-right'});
                }
             }
          });
    });

    $(".quest-avaliable").change(function() {
        var id = $(this).val();

        var quest_title = $("#quest-title-" + id).html();
        var quest_name = $("#quest-name-" + id).html();
        var quest_description = $("#quest-description-" + id).html();
        var quest_objetivos = $("#quest-objetivos-" + id).html();
        var xp_reward = $("#xp-reward-" + id).html();
        var money_reward = $("#money-reward-" + id).html();

        $(".quest-title").html(quest_title);
        $(".quest-description").html(quest_description);
        $(".quest-objetivos").html(quest_objetivos);
        $(".xp-reward").html(xp_reward);
        $(".money-reward").html(money_reward);
        $(".accept-quest").attr('href', '{{ url('/game/quest')}}' + '/' + quest_name);
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
            scalestars: 2.5,
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
