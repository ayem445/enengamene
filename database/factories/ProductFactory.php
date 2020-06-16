<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => ucfirst($faker->unique()->words(3, true)),
        'price' => $faker->unique()->randomFloat(2, 0, 100)
    ];
});
