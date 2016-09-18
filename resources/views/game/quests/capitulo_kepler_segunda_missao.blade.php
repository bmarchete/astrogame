@extends('game.general.general')
@section('title')
As três leis fundamentais | {{ trans('project.title') }}
@stop

@section('javascript')
<script>
$(document).ready(function(){
		background3.play();
});
var quest = 'capitulo_kepler_segunda_missao';

var questions = [{
    question: "O que regem as Leis de Kepler?",
    choices: ["O movimento da Terra", "O movimento do Sol", "O movimento Planetário", "O movimento Quartenário"],
    correctAnswer: 2
}, {
    question: "Quais as três leis de Kepler?",
    choices: ["Leis das Órbitas, da Gravidade e do Tempo", "Leis das Órbitas, das Áreas e dos Períodos", "Lei das Áreas, dos Circulos e dos Trapézios", "Lei das Órbitas, do Espaço e da Expansão "],
    correctAnswer: 1
}, {
    question: "O que afirma a Lei das Orbitas?",
    choices: ["Os planetas percorrem órbitas circulares", "Os planetas não percorrem órbitas", "Os planetas giram em torno de si mesmos", "Os planetas percorrem órbitas elipticas"],
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
		 <div class="cientist-message">
         <span class="bubble cientist-text">Agora vamos testar seu conhecimento sobre as três Leis de Kepler, você está pronto?</span>
     </div>
     <img src="{{ URL('/img/char/kepler.png')}}" class="cientist uk-animation-hover uk-animation-shake" alt="">
  </div>
  </div>
@stop
