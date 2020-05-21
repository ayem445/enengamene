<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Auteur;
use Faker\Generator as Faker;

$factory->define(Auteur::class, function (Faker $faker) {
    return [
      'resume' => $faker->paragraph(3),
      'personne_id' => function() {
        return factory(\App\Personne::class)->create()->id;
      },
    ];
});
