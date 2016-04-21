<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ItemsSeeder::class);
        $this->call(QuestsSeeder::class);
        $this->call(QuizSeeder::class);
        $this->call(InsignasSeeder::class);
        $this->call(PostSeeder::class);
    }
}
