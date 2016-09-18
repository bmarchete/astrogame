@extends('game.general.general')
@section('title')
Testando o conhecimento | {{ trans('project.title') }}
@stop

@section('javascript')
<script>
$(document).ready(function(){
		background3.play();
});
var quest = 'capitulo_galileu_quarta_missao';

var questions = [{
    question: "Do que são formadas as estrelas?",
    choices: ["Força e Gravidade", "Oxigênio e Gases", "Gases e poeira", "Nuvens"],
    correctAnswer: 2
}, {
    question: "Onde as estrelas se formam?",
    choices: ["nas Galáxias", "em Nebulosas", "no Universo", "em berços Estelares"],
    correctAnswer: 3
}, {
    question: "Porque podemos dizer que, quando olhamos uma estrela, estamos enxergando o seu passado?",
    choices: ["Pois, na verdade, as estrelas não existem", "Pois todas as estrelas já morreram", "Pois o tempo é diferente no espaço", "Por causa da velocidade da luz"],
    correctAnswer: 3
}, {
    question: "Por que as contelações são 'aparentes'?",
    choices: ["Pois as estrelas estão muito longe uma das outras", "Pois o seu formato só se parece com figuras", "Pois muitas dessas estrelas já morreram", "Pois as estrelas mudam de lugar"],
    correctAnswer: 0
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
         <span class="bubble cientist-text">Agora vamos testar o seu conhecimento sobre as estrelas...</span>
     </div>
     <img src="{{ URL('/img/char/galileu-01.png')}}" class="cientist uk-animation-hover uk-animation-shake" alt="">
  </div>
  </div>
@stop
