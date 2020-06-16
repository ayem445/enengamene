<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Quiz;
use Faker\Generator as Faker;

$factory->define(Quiz::class, function (Faker $faker) {
    $libelle = $faker->sentence(1);
    return [
      'code' => Quiz::getUniqcode(),
      'libelle' => $libelle,
      'description' => $faker->paragraph(),
      'commentaire' => $faker->paragraph(),
      'is_complet' => true
    ];
});
