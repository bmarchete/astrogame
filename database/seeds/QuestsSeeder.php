<?php

use Illuminate\Database\Seeder;

class QuestsSeeder extends Seeder
{
    public $quests = [
        [
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
            'title' => 'Segunda Missão!',
            'type' => 1,
            'description' => '',
            'objetivos' => 'Ver tudo sem pular e curtir as belas imagens do universo!',
            'xp_reward' => 500,
            'money_reward' => 1000,
            'min_level' => 1,
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
                $this->command->info('Quest: '.e($quest['title']).' adicionado, ignorada.');
            }
        }
    }
}
