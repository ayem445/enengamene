<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Chapitre;
use App\Difficulte;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Chapitre::class, function (Faker $faker) {
    $libelle = $faker->sentence(1);
    $difficulte_max_id = Difficulte::max('id');
    return [
        'code' => uniqid(Str::slug($libelle), true),
        'libelle' => $libelle,
        'description' => $faker->paragraph(2),
        'cour_id' => function() {
          return factory(\App\Cour::class)->create()->id;
        },
        'num_ordre' => 100,
        'difficulte_id' => $faker->numberBetween($min = 1, $max = $difficulte_max_id)
    ];
});
