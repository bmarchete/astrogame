<?php

use Illuminate\Database\Seeder;

class QuestsSeeder extends Seeder
{
    public $quests = [
        [
            'id' => 1,
            'title' => 'Primeira Missão!',
            'type' => 1,
            'description' => 'Mais uma vez, seja bem vindo ao Astrogame, sua primeira missão é concluir o capítulo de boas vindas assistindo a todos os videos que aparecer na tela, é rápido e não vai demorar, curta o show do cosmos!',
            'objetivos' => 'Ver tudo sem pular e curtir as belas imagens do universo!',
            'xp_reward' => 500,
            'money_reward' => 1000,
            'min_level' => 1,
            'max_level' => 0,
        ],

        [
            'id' => 2,
            'title' => 'Pequena pálida missão!',
            'type' => 1,
            'description' => 'Nessa missão você terá que assistir por completo a mensagem deixada por Carl Sagan quando a espaçonave Voayger 1 passou por Juptier e avistou um pequeno pálido ponto azul, a Terra como um grão de areia.',
            'objetivos' => 'Assistir ao video completo do pequeno pálido ponto azul',
            'xp_reward' => 150,
            'money_reward' => 450,
            'min_level' => 1,
            'max_level' => 0,
        ],

        [
            'id' => 3,
            'title' => 'Projeto Cosmos',
            'type' => 1,
            'description' => 'Você passou pelo stand do Projeto Cosmos na expoete 2015?',
            'objetivos' => 'Responder ao quizz do projeto cosmos',
            'xp_reward' => 500,
            'money_reward' => 300,
            'min_level' => 1,
            'max_level' => 0,
        ],

        [
            'id' => 4,
            'title' => 'Chame um amigo!',
            'type' => 1,
            'description' => 'Curtiu o projeto astrogame? Ajude ele a crescer convidando um amigo a entrar no jogo!',
            'objetivos' => 'Responder ao quizz do projeto cosmos',
            'xp_reward' => 100,
            'money_reward' => 200,
            'min_level' => 2,
            'max_level' => 0,
        ],

        [
            'id' => 5,
            'title' => 'Apollo 11',
            'type' => 1,
            'description' => '<p>Tripulada pelos astronautas Neil Armstrong, Edwin \'Buzz\' Aldrin e Michael Collins, Apollo 11 foi a quinta missão tripulada do programa Apollo que conseguiu cumprir a missão proposta pelo Presidente John F. Kennedy em 25 de maio de 1961 que disse que antes do final daquela década conseguiria pousar um homem na Lua e trazê-lo de volta para a Terra com segurança.</p><p>A missão de você é conseguir assistir até o final da simulação criada pelo Filipe Dias Gianotto e ao final você irá ganhar uma insigna da missão Apollo 11!</p>',
            'objetivos' => 'Assistir ao video simulação completo da Apollo 11.',
            'xp_reward' => 500,
            'money_reward' => 50,
            'min_level' => 4,
            'max_level' => 0,
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run()
    {
        foreach ($this->quests as $quest) {
            if (DB::table('quests')->where('title', $quest['title'])->get() == null) {
                DB::table('quests')->insert($quest);
                $this->command->info('Quest: '.e($quest['title']).' adicionado.');
            }
        }
    }
}
