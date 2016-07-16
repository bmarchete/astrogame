<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'nickname' => str_random(10),
        'type' => 1,
        'remember_token' => str_random(10),
        'xp' => rand(200, 10000),
        'level' => rand(1, 13)
    ];
});

$factory->define(App\History::class, function (Faker\Generator $faker) {
    return [
        'texto' => $faker->sentence(5),
        'user_id' => \App\User::orderByRaw('RAND()')->first()->id,
        'icon' => function(){
            $icons = ['check', 'space-shuttle', 'shopping-cart'];
            $random_index = rand(0, count($icons) - 1);
            return $icons[$random_index];
        },
    ];
});
