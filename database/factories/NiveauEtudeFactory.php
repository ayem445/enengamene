<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\NiveauEtude;
use Faker\Generator as Faker;

$factory->define(NiveauEtude::class, function (Faker $faker) {
    $libelle = $faker->sentence(1);
    return [
      'code' => NiveauEtude::getUniqcode(),
      'libelle' => $libelle,
      'level' => $faker->numberBetween($min = 1, $max = 10)
    ];
});
