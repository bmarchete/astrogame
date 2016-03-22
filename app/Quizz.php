<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cache;

class Quizz extends Model
{
    // @TODO: finish
    public static function makeHTML(){
    	Quizz::cacheQuizzes();
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
