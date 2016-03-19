<?php

use Illuminate\Database\Seeder;

class QuestsSeeder extends Seeder
{

	public $quests = [
		[
			'title' => 'Apollo 11',
			'type' => 1,
			'id_reponsable' => 1,
			'description' => 'Desde 1960 a missão apollo...',
			'objetivos' => '100 de xp',
			'xp_reward' => 100,
			'timer' => 0,
			'min_level' => 1,
			'max_level' => 0
		],
	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->quests as $quest){
    		if(DB::table('quests')->where('title', $quest['title'])->get() == null){
    			DB::table('quests')->insert($quest);
    		} else {
    			echo '[ INFO ] Quest: ' . $quest['title'] . " ja existe, ignorada. \n";
    		}
    	}
    }
}
