@extends('game.general.general')
@section('title')
Testando o conhecimento | {{ trans('project.title') }}
@stop

@section('javascript')
<script>
$(document).ready(function(){
		background2.play();
});
var quest = 'capitulo_hubble_segunda_missao';

var questions = [{
    question: "O universo está.....?",
    choices: ["...sempre parado", "...morrendo", "...sempre em movimento", "...flutuando"],
    correctAnswer: 2
}, {
    question: "Quais são as três classificações básicas de uma galáxia?",
    choices: ["Espirais, Redondas e Planas", "Verticais, Elípticas e Irregulares", "Espirais, Elípticas e Irregulares", "Circulares, Planas e Irregulares"],
    correctAnswer: 2
}, {
    question: "Qual tipo de galáxia não possui muitos gases e poeiras, assim, tendo poucas estrelas jovens?",
    choices: ["Espirais", "Elípticas", "Irregulares", "Todas as opções"],
    correctAnswer: 3
}, {
    question: "De acordo com a Lei de Hubble, se uma galáxia está se aproximando de nós, ela emite uma cor..",
    choices: ["Azul", "Roxa", "Vermelha", "Amarela"],
    correctAnswer: 2
}];
</script>
{!! Minify::javascript(['/js/game/quizz.js'])->withFullURL() !!}
@stop

@section('content')
  <div class="uk-container uk-container-center game-section">
     <div class="uk-grid">
        <div class="uk-width-1-2 uk-container-center uk-panel uk-panel-box">
           <h3 class="uk-panel-title"></h3>
           <div class="quizContainer">
              <h1 class="question"></h1>
              <ul class="choiceList uk-list-line"></ul>
              <div class="uk-alert uk-alert-danger quizMessage" style="display:none" data-uk-alert>
                 <a href="#" class="uk-alert-close uk-close"></a>
                 <p class="message">Por favor, selecione uma resposta</p>
              </div>
              <div class="result"></div>
              <div class="uk-button uk-button-success nextButton uk-align-right">Próxima pergunta <i class="uk-icon-arrow-circle-right"></i></div>
           </div>

        </div>
     </div>
     <div class="cientist-message">
         <span class="bubble cientist-text">Agora vamos testar de novo seu conhecimento...</span>
     </div>
     <img src="{{ URL('/img/char/hubble.png')}}" class="cientist uk-animation-hover uk-animation-shake" alt="">
  </div>
  </div>
@stop
