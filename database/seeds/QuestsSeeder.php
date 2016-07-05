<?php

use Illuminate\Database\Seeder;

class QuestsSeeder extends Seeder
{

    public $quests = [
        [
            'title'          => 'Primeira Missão!',
            'type'           => 1,
            'id_responsable' => 1,
            'description'    => 'Mais uma vez, seja bem vindo ao Astrogame, sua primeira missão é concluir o primeiro capítulo assistindo a todos os videos que aparecer na tela, é rápido e não vai demorar, curta o show do cosmos!',
            'objetivos'      => '500 de XP e belas imagens',
            'xp_reward'      => 500,
            'timer'          => 0,
            'min_level'      => 1,
            'max_level'      => 0,
        ],

        [
            'title'          => 'Apollo 12',
            'type'           => 1,
            'id_responsable' => 1,
            'description'    => 'TUDO MUITO LOUCO',
            'objetivos'      => '100 de xp',
            'xp_reward'      => 100,
            'timer'          => 0,
            'min_level'      => 1,
            'max_level'      => 0,
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->quests as $quest) {
            if (DB::table('quests')->where('title', $quest['title'])->get() == null) {
                DB::table('quests')->insert($quest);
                $this->command->info('Quest: ' . e($quest['title']) . " adicionado, ignorada.");
              }
        }
    }
}
