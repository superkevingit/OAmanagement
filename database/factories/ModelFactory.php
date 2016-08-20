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
        'phone' => $faker->phoneNumber,
        'student_id' => null,
        'password' => bcrypt(str_random(6)),
        'remember_token' => str_random(10),
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ];
});

$factory->define(App\OrganizationTag::class, function (Faker\Generator $faker) {
    return [
        'name' => str_random(5),
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ];
});

$factory->define(App\OauthClient::class, function (Faker\Generator $faker) {
    return [
        'id' =>str_random(38),
        'secret' => str_random(38),
        'name' => $faker->word,
    ];
});
