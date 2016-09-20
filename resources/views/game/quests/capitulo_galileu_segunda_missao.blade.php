@extends('game.general.general')
@section('title')
Mãos a obra
@stop

@section('javascript')
<script>
play_music('background3');
////////////////////////////////// montar telescópio
var game = new Phaser.Game('100', '100', Phaser.AUTO, 'game', { preload: preload, create: create, update: update}, '#game', null, false);
var tubo_telescopico;
var buscador;
var tripe;
var tubo_telescopico_placed = false;
var buscador_placed = false;
var tripe_placed = false;


function preload() {
    game.load.image('completo', '{{ asset('img/quests/telescopio_completo.jpg')}}');
    game.load.image('buscador', '{{ asset('img/items/buscador.png') }}');
    game.load.image('tripe', '{{ asset('img/items/tripe.png') }}');
    game.load.image('tubo_telescopico', '{{ asset('img/items/tubo-telescopico.png') }}');
}

function create(){
  game.physics.startSystem(Phaser.Physics.ARCADE);
  game.add.sprite(game.world.centerX - 250, game.world.centerY - 250, 'completo');

  tubo_telescopico = game.add.sprite(0, 0, 'tubo_telescopico');
  buscador = game.add.sprite(0, 0, 'buscador');
  tripe = game.add.sprite(0, 0, 'tripe');

  buscador.scale.x = 0.4;
  buscador.scale.y = 0.4;

  tubo_telescopico.inputEnabled = true;
  tubo_telescopico.input.enableDrag();

  buscador.inputEnabled = true;
  buscador.input.enableDrag();

  tripe.inputEnabled = true;
  tripe.input.enableDrag();

}


function update() {

    if(!tubo_telescopico_placed && (tubo_telescopico.x >= 515 && tubo_telescopico.x <= 530 ) &&
       (tubo_telescopico.y >= 175 && tubo_telescopico.y <= 190 )){
        tubo_telescopico.inputEnabled = false;
        tubo_telescopico_placed = true;
    }

    if(!tripe_placed && (tripe.x >= 520 && tripe.x <= 525 ) &&
       (tripe.y >= 170 && tripe.y <= 190 )){
         tripe.inputEnabled = false;
         tripe_placed = true;
       }

       if(!buscador_placed && (buscador.x >= 770 && buscador.x <= 790 ) &&
          (buscador.y >= 200 && buscador.y <= 220 )){
            buscador.inputEnabled = false;
            buscador_placed = true;
          }

    if(tripe_placed && tubo_telescopico_placed && buscador_placed){
        handleFinal();
    }
}

function handleFinal(){
  $(document).find('.cientist-box').show();
  $(document).find('.controls').show();
    text_cientist('Muito bem, você possui um telescópio e muita força de vontade, está tudo pronto para começarmos nossa observação!');
}
</script>
@endsection

@section('content')
  <div id="game"></div>
  <div class="uk-container uk-container-center game-section">
     <div class="cientist-box">
     <div class="cientist-message">
         <span class="bubble cientist-text">Muito bem, agora podemos começar a montar nosso telescópio!</span>
     </div>
     <div class="controls" style="display: none">
       <button class="uk-button uk-button-danger" onclick="complete_quest('capitulo_galileu_segunda_missao')"><i class="uk-icon-exclamation"></i> Completar Missão</button>
     </div>
     <img src="{{ URL('/img/char/galileu-01.png')}}" class="cientist uk-animation-hover uk-animation-shake" alt="">
   </div>
  </div>
  </div>

@endsection
