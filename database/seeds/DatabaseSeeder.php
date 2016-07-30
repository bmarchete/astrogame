<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->call(ItemsSeeder::class);
        $this->call(QuestsSeeder::class);
        $this->call(InsignasSeeder::class);

        if (env('APP_ENV') == 'local') {
            $confirm = $this->command->confirm('Deseja rodar os test seeders?');
            if ($confirm) {
                factory(App\User::class, 500)->create()->each(function ($user) {
                    factory(App\History::class, 10)->create(['user_id' => $user->id]);
                    factory(App\UsersQuest::class, 2)->create(['user_id' => $user->id]);
                    factory(App\UserBag::class, 5)->create(['user_id' => $user->id]);
                    factory(App\UserInsignas::class, 10)->create(['user_id' => $user->id]);
                });
                $this->command->info('Adicionado 500 users aleatorios com history, quests, bag e insignas');
            }
        }
    }
}
