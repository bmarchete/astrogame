<?php

use Illuminate\Database\Seeder;

class InsignasSeeder extends Seeder
{
    /** 
	 * Todos as insignas devem ser colocados aqui
	 */
	public $insignas = [
		
		[
			'name' => 'Apollo 11',
			'reason' => 'Ganha quando completa a missão da apollo 11',
			'img_url' => 'basic_telescope',
		],
	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	foreach($this->insignas as $insigna){
    		if(DB::table('insignas')->where('name', $insigna['name'])->get() == null){
    			DB::table('insignas')->insert($insigna);
    			echo '[ INFO ] Insigna: ' . htmlspecialchars($insigna['name']) . " adicionada. \n";
    		}
    	}
    }
}
