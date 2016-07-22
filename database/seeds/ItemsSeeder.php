<?php

use Illuminate\Database\Seeder;

class ItemsSeeder extends Seeder
{

    /**
     * Todos os items devem ser colocados aqui
     */
    public $items = [

        [
            'id'          => 1,
            'name'        => 'Luneta Simples',
            'description' => 'Alcance: Curto. Descrição: Permite uma visão superficial do céu.',
            'price'       => 50,
            'min_level'   => 1,
            'img_url'     => 'basic_telescope',
            'max_stack'   => 1,
        ],

        [
            'id'          => 2,
            'name'        => 'Guia das Estrelas Vol. 1',
            'description' => 'Abre a magnitude máxima das estrelas no céu',
            'price'       => 25,
            'min_level'   => 1,
            'img_url'     => 'book_1',
            'max_stack'   => 1,
            // 'text'        => '',
        ],

        [
            'id'          => 3,
            'name'        => 'Guia das Constelações Vol. 1',
            'description' => 'Mostra as linhas de contelações no céu',
            'price'       => 50,
            'min_level'   => 1,
            'img_url'     => 'book_2',
            'max_stack'   => 1,
            // 'text'        => '',
        ],

        [
            'id'          => 4,
            'name'        => 'Guia das Estrelas Vol. 3',
            'description' => 'Abre as estrelas no céu',
            'price'       => 150,
            'min_level'   => 1,
            'img_url'     => 'book_3',
            'max_stack'   => 1,
            // 'text'        => '',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->items as $item) {
            if (DB::table('items')->where('name', $item['name'])->get() == null) {
                DB::table('items')->insert($item);
                $this->command->info('Item: ' . e($item['name']) . " adicionado.");
            }
        }
    }
}
