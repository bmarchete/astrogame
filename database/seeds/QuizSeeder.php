<?php

use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{

	public $quizzes = [
		
		[
            'pergunta' => 'Do que são formadas as estrelas?',
            'resposta1' => 'Força e Gravidade',
            'resposta2' => 'Oxigênio e Gases',
            'resposta3' => 'Gases e poeira',
            'resposta4' => 'Nuvens',
            'resposta5' => 'Luzes e meteoritos',
            'correta' => 3
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
                echo '[ INFO ] Quizz: ' . e($quizze['pergunta']) . " adicionado. \n";
    		}
    	}
    }
}
