<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Session;
use Faker\Generator as Faker;

$factory->define(Session::class, function (Faker $faker) {
    $libelle = $faker->sentence(1);
    return [
      'code' => Session::getUniqcode(),
      'libelle' => $libelle,
      'description' => $faker->paragraph(2),
      'commentaire' => $faker->paragraph(1),
      'chapitre_id' => function() {
        return factory(\App\Chapitre::class)->create()->id;
      },
      'num_ordre' => 1,
      'lien' => '230485453',
      'type_contenu_id' => 1,
      'taille_o' => 0,
      'duree_s' => 0,
      'duree_hhmmss' => "00:00:00",
      'width' => 0,
      'height' => 0,
      'stats_number_of_likes' => 0,
      'stats_number_of_plays' => 0,
      'stats_number_of_comments' => 0
    ];
});
