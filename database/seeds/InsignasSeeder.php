<?php

use Illuminate\Database\Seeder;

class InsignasSeeder extends Seeder
{
    /** 
	 * Todos as insignas devem ser colocados aqui
	 */
	public $insignas = [
		
		[
			'name' => 'Project Mercury',
			'reason' => 'Project Mercury foi o primeiro programa Americano de voo especial. Ele consiste em uma tripulação de 6 e missões de 1961 a 1963. Alan Shepard foi o primeiro Americano no espaço em 5 de maio em 1962',
			'img_url' => 'Project Mercury'            
		],

        /*
        [
            'name' => '',
            'reason' => '',
            'img_url' => ''
        ]

        [
            'name' => '',
            'reason' => '',
            'img_url' => ''
        ]

        [
            'name' => '',
            'reason' => '',
            'img_url' => ''
        ]

        [
            'name' => '',
            'reason' => '',
            'img_url' => ''
        ]

        [
            'name' => '',
            'reason' => '',
            'img_url' => ''
        ]

        [
            'name' => '',
            'reason' => '',
            'img_url' => ''
        ]

        [
            'name' => '',
            'reason' => '',
            'img_url' => ''
        ]

        [
            'name' => '',
            'reason' => '',
            'img_url' => ''
        ]

        [
            'name' => '',
            'reason' => '',
            'img_url' => ''
        ]

        [
            'name' => '',
            'reason' => '',
            'img_url' => ''
        ]

        [
            'name' => '',
            'reason' => '',
            'img_url' => ''
        ]

        [
            'name' => '',
            'reason' => '',
            'img_url' => ''
        ]

        [
            'name' => '',
            'reason' => '',
            'img_url' => ''
        ]

        [
            'name' => '',
            'reason' => '',
            'img_url' => ''
        ]

        [
            'name' => '',
            'reason' => '',
            'img_url' => ''
        ]*/
          
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
