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
			'img_url' => 'apollo_11',
		],

        [
            'name' => 'Space Shuttle',
            'reason' => 'Ganha quando utiliza uma nava espacial',
            'img_url' => 'space_shuttle',
        ],

        [
            'name' => 'Apollo 12',
            'reason' => 'Ganha quando completa a missão da apollo 11',
            'img_url' => 'apollo_11',
        ],

        [
            'name' => 'Apollo 13',
            'reason' => 'Ganha quando completa a missão da apollo 11',
            'img_url' => 'apollo_11',
        ],

        [
            'name' => 'Apollo 14',
            'reason' => 'Ganha quando completa a missão da apollo 11',
            'img_url' => 'apollo_11',
        ],

        [
            'name' => 'Apollo 15',
            'reason' => 'Ganha quando completa a missão da apollo 11',
            'img_url' => 'apollo_11',
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
