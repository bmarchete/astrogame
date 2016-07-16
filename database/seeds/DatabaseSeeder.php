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
        $this->call(InsignasSeeder::class);

        factory(App\User::class, 10)->create();
        factory(App\History::class, 10)->create();

    }
}
