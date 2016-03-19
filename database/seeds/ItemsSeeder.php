<?php

use Illuminate\Database\Seeder;

class ItemsSeeder extends Seeder
{

	/** 
	 * Todos os items devem ser colocados aqui
	 */
	public $items = [
		
		[
			'name' => 'Telescópio básico',
			'description' => 'Usado por telescópios anônimos',
			'price' => 42,
			'min_level' => 1,
			'img_url' => 'basic_telescope',
		],


		[
			'name' => 'Telescópio avançado',
			'description' => 'Usado por bons telescópios',
			'price' => 52,
			'min_level' => 2,
			'img_url' => 'basic_telescope'
		],

		[
			'name' => 'Livro de constelações',
			'description' => 'Livro antigo',
			'price' => 30,
			'min_level' => 2,
			'img_url' => 'book_1'
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
    		} else {
    			echo '[ INFO ] Item: ' . $item['name'] . " ja existe, ignorada. \n";
    		}
    	}
    }
}
