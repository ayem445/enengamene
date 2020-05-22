<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Matiere;
use Faker\Generator as Faker;

$factory->define(Matiere::class, function (Faker $faker) {
    $libelle = $faker->sentence(1);
    return [
        'code' => Matiere::getUniqcode(),
        'libelle' => $libelle,
        'description' => $faker->paragraph(),
        'commentaire' => $faker->paragraph()
    ];
});
