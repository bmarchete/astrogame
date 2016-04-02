<?php

use Illuminate\Database\Seeder;

class ItemsSeeder extends Seeder
{

	/** 
	 * Todos os items devem ser colocados aqui
	 */
	public $items = [
		
		[
			'name' => 'Luneta Simples',
			'description' => 'Alcance: Curto. Descrição: Permite uma visão superficial do céu.',
			'price' => 50,
			'min_level' => 1,
			'img_url' => 'basic_telescope',
			'max_stack' => 1,
		],


		[
			'name' => 'Guia das Estrelas',
			'description' => 'Desbloqueia missões de nivel 1 - 5',
			'price' => 25,
			'min_level' => 1,
			'img_url' => 'book_1',
			'max_stack' => 1,
			// 'text' => '',
		],
	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	foreach($this->items as $item){
    		if(DB::table('items')->where('name', $item['name'])->get() == null){
    			DB::table('items')->insert($item);
    			echo '[ INFO ] Item: ' . e($item['name']) . " adicionado. \n";
    		}
    	}
    }
}
