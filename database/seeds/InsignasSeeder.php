<?php

use Illuminate\Database\Seeder;
use App\Models\Insignas;

class InsignasSeeder extends Seeder
{
    public $insignas = [

      [
          'name'    => 'Astrogame Staff',
          'reason'  => 'Faz parte da equipe de desenvolvimento do astrogame, insigna exclusiva apenas de 5 membros',
          'how'     => 'Fazer parte da equipe de desenvolvimento',
          'img_url' => 'astrogame',
      ],

      [
          'name'    => 'Beta tester',
          'reason'  => 'Entrou no começo do astrogame e ajudou o jogo crescer :)',
          'how'     => 'Ter participado da versão beta do astrogame durante seu período de desenvolvimento',
          'img_url' => 'beta',
      ],

    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->insignas as $insigna) {
            if (Insignas::where('name', $insigna['name'])->get() == null) {
                Insignas::insert($insigna);
                $this->command->info(e($insigna['name']) . " adicionada.");
            }
        }
    }
}
