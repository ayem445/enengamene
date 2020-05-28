<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Personne;
use Faker\Generator as Faker;

$factory->define(Personne::class, function (Faker $faker) {
    $gender = $faker->randomElement(['H', 'F']);
    $lastName = $faker->lastName;
    $uniqcode = Personne::getUniqcode();
    return [
        'code' => $uniqcode,
        'email' => $faker->unique()->safeEmail,
        'nom' => $lastName,
        'prenom' => $faker->firstName,
        'sexe' => $gender,
        'adresse' => $faker->address,
        'telephone' => $faker->phoneNumber,
        'fonction' => $faker->jobTitle,
        'pays' => $faker->country
    ];
});
