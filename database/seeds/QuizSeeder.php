<?php

use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{

	public $quizzes = [
		
		[
            'pergunta' => 'Qual o nome da explosão que deu origem ao universo?',
            'resposta1' => 'Bang Bang',
            'resposta2' => 'Big Bang',
            'resposta3' => ' Boom Bang',
            'resposta4' => 'Big Boom',
            'resposta5' => '',
            'correta' => 1
        ],

        [
            'pergunta' => 'Qual destas alternativas possui uma temperatura na superfície de 5500 ° C?',
            'resposta1' => 'Supernova',
            'resposta2' => 'Buraco Negro',
            'resposta3' => 'Sol',
            'resposta4' => 'Meteoro',
            'resposta5' => '',
            'correta' => 3
        ],

        [
            'pergunta' => 'As erupções solares são _________ a nós.',
            'resposta1' => 'Toleráveis',
            'resposta2' => 'Agradáveis',
            'resposta3' => 'Fundamentais',
            'resposta4' => 'Nocivas',
            'resposta5' => '',
            'correta' => 4
        ],

        [
            'pergunta' => 'Qual o terceiro planeta a partir do Sol e o primeiro do sistema que possui um satélite natural?',
            'resposta1' => 'Terra',
            'resposta2' => 'Saturno',
            'resposta3' => 'Mercúrio',
            'resposta4' => 'Marte',
            'resposta5' => '',
            'correta' => 1
        ],

        [
            'pergunta' => 'Pontos luminosos em movimento que são gerados por corpos celestes que ultrapassam rapidamente a atmosfera e se desintegram rapidamente são:',
            'resposta1' => 'Supernovas',
            'resposta2' => 'Buracos Negros',
            'resposta3' => 'Estrelas',
            'resposta4' => 'Meteoro',
            'resposta5' => '',
            'correta' => 4
        ],

        [
            'pergunta' => 'Poderíamos desfrutar do show do COSMOS se não houvesse:',
            'resposta1' => 'Nuvens e chuva',
            'resposta2' => 'Nuvens e poluição',
            'resposta3' => 'Luminosidade e atmosfera',
            'resposta4' => 'Luminosidade e poluição',
            'resposta5' => '',
            'correta' => 4
        ],

        [
            'pergunta' => 'Supernova é:',
            'resposta1' => 'A morte de uma estrela',
            'resposta2' => 'O nascimento de uma estrela',
            'resposta3' => 'A morte de um buraco negro',
            'resposta4' => 'A morte de um planeta',
            'resposta5' => '',
            'correta' => 1
        ],

        [
            'pergunta' => 'Buracos negros conseguem atrair tudo para si pois:',
            'resposta1' => 'Possuem campos eletromagnéticos',
            'resposta2' => 'Possuem atmosfera',
            'resposta3' => 'Possuem forte gravidade',
            'resposta4' => 'Não possuem gravidade',
            'resposta5' => '',
            'correta' => 3
        ],

        [
            'pergunta' => 'O que são Exoplanetas?',
            'resposta1' => 'Planetas não habitáveis',
            'resposta2' => 'Planetas habitáveis',
            'resposta3' => 'Planetas em formação',
            'resposta4' => 'Planetas Mortos',
            'resposta5' => '',
            'correta' => 2
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
                echo '[ INFO ] Quizz: ' . $quizze['pergunta'] . " adicionado. \n";
    		}
    	}
    }
}
