<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cour;
use App\Matiere;
use App\Auteur;
use App\NiveauEtude;
use Faker\Generator as Faker;

$factory->define(App\Cour::class, function (Faker $faker) {
    $matiere_max_id = Matiere::max('id');
    $auteur_max_id = Auteur::max('id');
    if (! $auteur_max_id) {
      factory(App\Auteur::class, 10)->create();
      $auteur_max_id = Auteur::max('id');
    }
    $niveauetude_max_id = NiveauEtude::max('id');
    $libelle = $faker->sentence(2);
    return [
        'code' => Cour::getUniqcode(),
        'libelle' => $libelle,
        'image_url' => 'default.jpg',
        'description' => $faker->paragraph(),
        'matiere_id' => $faker->numberBetween($min = 1, $max = $matiere_max_id),
        'auteur_id' => $faker->numberBetween($min = 1, $max = $auteur_max_id),
        'niveau_etude_id' => $faker->numberBetween($min = 1, $max = $niveauetude_max_id)
    ];
});
