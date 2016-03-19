<?php

use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{

	public $quizzes = [
		
		[
			'pergunta' => 'Qual a galáxia mais próxima',
			'resposta1' => 'Andromera',
			'resposta2' => 'Centauros',
			'resposta3' => 'Muito Louco',
			'resposta4' => 'É isso',
			'resposta5' => '',
			'correta' => 1
		],

	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->quizzes as $quizze){
    		if(DB::table('quizzs')->where('pergunta', $quizze['pergunta'])->get() == null){
    			DB::table('quizzs')->insert($quizze);
    		} else {
    			echo '[ INFO ] Quizz: ' . $quizze['pergunta'] . " ja existe, ignorado. \n";
    		}
    	}
    }
}
