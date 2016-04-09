<?php

namespace AstroGame;

use Illuminate\Database\Eloquent\Model;
use Cache;

class Quizz extends Model
{
    // @TODO: finish
    public static function makeHTML($id){
        $quiz = Quizz::where('id', $id)->limit(1)->get()->first();

        $html = '<div class="uk-modal quiz-'.$id.'">';
        $html .= '<div class="uk-modal-dialog">';
        $html .= '<form action="" method="POST">';
        $html .= '<a class="uk-modal-close uk-close"></a>';
        $html .= '<h3>' . $quiz->pergunta . '</h3>';
        $html .= '<ul class="uk-list uk-list-striped">';

        for ($i=1; $i < 5; $i++) { 
            $html .= '<li>('. $i.')<input type="radio" name="resposta" value="'. $i.'">' . eval('return $quiz->resposta' . $i . ';') .  '</li>';
        }
        $html .= '</ul>';
        $html .= '<div class="uk-modal-footer">';
        $html .= '<button type="submit" class="uk-button uk-button-success">Essa é a resposta</button>';
        $html .= '</div>';
        $html .= '</form>';
        $html .= '</div>';
        $html .= '</div>';
        
        return $html;
    }

    public static function check_answer($quizz_id, $answer) {

    }

    // @TODO: check and finish
    protected static function cacheQuizzes(){
    	if(Cache::has('quizzes')){
    		return Cache::get('quizzes');
    	}

    	$quizzes = Quizz::get();
    	Cache::rememberForever('quizzes', $quizzes);
    	return $quizzes;
    }
}
