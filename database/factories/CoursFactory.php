<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cour;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Cour::class, function (Faker $faker) {
    return [
        'code' => uniqid(Str::slug(Str::random(10)), true),
        'libelle' => $faker->sentence(2),
        'image_url' => asset('assets/img/series.jpg'),
        'description' => $faker->paragraph()
    ];
});
