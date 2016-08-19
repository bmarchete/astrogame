<?php

use Illuminate\Database\Seeder;

class QuestsSeeder extends Seeder
{
    public $quests = [

        [
            'name' => 'primeira_missao',
            'title' => 'Primeira Missão!',
            'type' => 2, // chapter
            'description' => 'Mais uma vez, seja bem vindo ao Astrogame, sua primeira missão é concluir o capítulo de boas vindas assistindo a todos os videos que aparecer na tela, é rápido e não vai demorar, curta o show do cosmos!',
            'objetivos' => 'Ver tudo sem pular e curtir as belas imagens do universo!',
            'xp_reward' => 500,
            'money_reward' => 1000,
            'min_level' => 1,
            'max_level' => 0,
        ],

        [
            'name' => 'capitulo_copernico_primeira_missao',
            'title' => 'Capítulo I - O Pai da Astronomia - Alinhar as orbitas do planeta',
            'type' => 2, // chapter
            'description' => 'Copérnico, o Pai da Astronomia moderna, irá nos falar um pouco sobre a sua principal teoria, o Heliocentrismo!',
            'objetivos' => 'COMPLETAR O CAPÍTULO',
            'xp_reward' => 2500,
            'money_reward' => 1000,
            'min_level' => 1,
            'max_level' => 0,
        ],

        [
            'name' => 'capitulo_copernico_quizz',
            'title' => 'Capítulo I - Quizz',
            'type' => 2,
            'description' => 'DESCRIÇÃO',
            'objetivos' => 'COMPLETAR O QUIZZ',
            'xp_reward' => 3000,
            'money_reward' => 1000,
            'min_level' => 1,
            'max_level' => 0,
        ],

        [
            'name' => 'capitulo_galileu',
            'title' => 'Capítulo II - A Arte da observação',
            'type' => 2, // chapter
            'description' => 'O primeiro passo na nossa grande aventura é a observação, e Galileu Galilei é a pessoa certa para nos orientar nessa etapa!',
            'objetivos' => 'COMPLETAR O CAPÍTULO',
            'xp_reward' => 3000,
            'money_reward' => 1000,
            'min_level' => 1,
            'max_level' => 0,
        ],

        [
            'name' => 'capitulo_kepler',
            'title' => 'Capítulo III - As Leis Fundamentais',
            'type' => 2, // chapter
            'description' => 'Kepler nos apresenta suas três leis fundamentais, vamos entender como funciona o movimento planetário!',
            'objetivos' => 'COMPLETAR O CAPÍTULO',
            'xp_reward' => 2500,
            'money_reward' => 1000,
            'min_level' => 1,
            'max_level' => 0,
        ],

        [
            'name' => 'capitulo_hubble',
            'title' => 'Capítulo IV - O astrônomo, não o telescópio',
            'type' => 2, // chapter
            'description' => 'As galáxias são espetaculares, não é mesmo? Que tal aprender mais sobre elas com a ajuda do famoso Hubble!',
            'objetivos' => 'COMPLETAR O CAPÍTULO',
            'xp_reward' => 2500,
            'money_reward' => 1000,
            'min_level' => 1,
            'max_level' => 0,
        ],

        [
            'name' => 'capitulo_carl_sagan',
            'title' => 'Capítulo V - Carl Sagan',
            'type' => 2, // chapter
            'description' => 'Carl Sagan precisa de sua ajuda para construir a nave espacial Voyager e começar a explorar o universo!',
            'objetivos' => 'COMPLETAR O CAPÍTULO',
            'xp_reward' => 2500,
            'money_reward' => 1000,
            'min_level' => 1,
            'max_level' => 0,
        ],

        [
            'name' => 'missao_palido_ponto_azul',
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
            'name' => 'missao_projeto_cosmos',
            'title' => 'Projeto Cosmos',
            'type' => 1,
            'description' => 'Você passou pelo stand do Projeto Cosmos na expoete 2015?',
            'objetivos' => 'Assitir ou re-assistir o video completo do projeto cosmos',
            'xp_reward' => 500,
            'money_reward' => 300,
            'min_level' => 1,
            'max_level' => 0,
        ],

        [
            'name' => 'missao_amigo',
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
            'name' => 'missao_apollo_11',
            'title' => 'Apollo 11',
            'type' => 1,
            'description' => '<p>Tripulada pelos astronautas Neil Armstrong, Edwin \'Buzz\' Aldrin e Michael Collins, Apollo 11 foi a quinta missão tripulada do programa Apollo que conseguiu cumprir a missão proposta pelo Presidente John F. Kennedy em 25 de maio de 1961 que disse que antes do final daquela década conseguiria pousar um homem na Lua e trazê-lo de volta para a Terra com segurança.</p><p>A missão de você é conseguir assistir até o final da simulação criada pelo Filipe Dias Gianotto e ao final você irá ganhar uma insigna da missão Apollo 11!</p>',
            'objetivos' => 'Assistir ao video simulação completo da Apollo 11.',
            'xp_reward' => 500,
            'money_reward' => 50,
            'min_level' => 4,
            'max_level' => 0,
        ],

        [
            'name' => 'missao_cosmos_quizz',
            'title' => 'Projeto Cosmos Quizz',
            'type' => 1,
            'description' => 'Você visitou o projeto cosmos durante a expoete 2015? Teste seus conhecimentos sobre os diversos assuntos abordados nos stands do projeto com o mesmo quiz do percuso do Cosmos!',
            'objetivos' => 'Responder corretamente todas as questões do quizz do projeto cosmos',
            'xp_reward' => 500,
            'money_reward' => 50,
            'min_level' => 3,
            'max_level' => 0,
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run()
    {
        foreach ($this->quests as $quest) {
            if (DB::table('quests')->where('name', $quest['name'])->get() == null) {
                DB::table('quests')->insert($quest);
                $this->command->info('Quest: '.e($quest['title']).' adicionado.');
            }
        }
    }
}
