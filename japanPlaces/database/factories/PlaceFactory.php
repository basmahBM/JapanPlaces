<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Place::class, function (Faker $faker) {
    static $password;

    return [
        'name_en' => $faker->company,
        'long' => $faker->longitude,
        'lat' => $faker->latitude,
        'description' => $faker->text,
        'image_uri' => $faker->imageUrl(250,250),
        'category_id' => rand(1,15),
        'city_id' => rand(1,10),
       ];
});
