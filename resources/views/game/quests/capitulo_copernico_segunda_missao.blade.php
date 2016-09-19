@extends('game.general.general')
@section('title')
O Pai da Astronomia
@stop

@section('javascript')
{!! Minify::javascript(['/js/game/general.js'])->withFullURL() !!}
<script>
$(document).ready(function(){
		background3.play();
});
var quest = 'capitulo_copernico_segunda_missao';
var complete_quest_on_quiz_completed = true;

var questions = [{
    question: "Qual o nome da teoria que antecedeu a teoria de Copérnico?",
    choices: ["Teocentrismo", "Geocentrismo", "Antropocentrismo", "Heliocentrismo"],
    correctAnswer: 1
}, {
    question: "Como se chama o movimento que a Terra realiza em torno do Sol?",
    choices: ["Rotação", "Transação", "Translação", "Circular"],
    correctAnswer: 2
}, {
    question: "O que afirmava a Teoria do Heliocentrismo?",
    choices: ["A Terra é o centro do Universo", "O Sol é o centro do universo", "O Universo não possui centro", "A Terra gira em torno do Sol,  o qual está proximo ao centro do universo"],
    correctAnswer: 3
}, {
    question: "Qual é a segunda Lei de Kepler?",
    choices: ["Lei dos Períodos", "Lei das Áreas", "Lei das Elipses", "Lei dos Períodos"],
    correctAnswer: 1
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
		 <div class="cientist-box">
		 <div class="cientist-message">
         <span class="bubble cientist-text">Agora, aspirante, use o que você aprendeu para responder às perguntas!</span>
     </div>
     <img src="{{ URL('/img/char/copernico.png')}}" class="cientist uk-animation-hover uk-animation-shake" alt="">
	 </div>
  </div>
  </div>
@stop
