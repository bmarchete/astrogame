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
        'icon' => function(){
            $icons = ['check', 'space-shuttle', 'shopping-cart', 'exclamation'];
            $random_index = rand(0, count($icons) - 1);
            return $icons[$random_index];
        },
    ];
});

$factory->define(App\UsersQuest::class, function (Faker\Generator $faker) {
    return [
        'quest_id' => \App\Quest::orderByRaw('RAND()')->first()->id,
        'completed' => rand(0, 1),
    ];
});

$factory->define(App\UserBag::class, function (Faker\Generator $faker) {
    return [
        'item_id' => \App\Item::orderByRaw('RAND()')->first()->id,
        'amount' => rand(0, 3),
    ];
});

$factory->define(App\UserInsignas::class, function (Faker\Generator $faker) {
    return [
        'insigna_id' => \App\Insignas::orderByRaw('RAND()')->first()->id,
    ];
});
