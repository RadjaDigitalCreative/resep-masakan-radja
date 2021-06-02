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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    $name = $faker->name;

    return [
        'email' => str_slug($name).'@test.cz',
        'name' => $name,
        'slug' => str_slug($name),
        'verified' => false,
        'token' => str_random(30),
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Recipe::class, function (Faker\Generator $faker) use ($factory) {
    $title = $faker->sentence(4);

    return [
        'title' => $title,
        'slug' => str_slug($title),
        'body' => $faker->text.$faker->text,
        'duration_id' => rand(\DB::table('durations')->min('id'), \DB::table('durations')->max('id')),
        'difficulty_id' => rand(\DB::table('difficulties')->min('id'), \DB::table('difficulties')->max('id')),
        'user_id' => 1, // admin
    ];
});
