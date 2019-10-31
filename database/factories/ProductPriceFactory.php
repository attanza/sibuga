<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductPrice;
use Faker\Generator as Faker;

$factory->define(ProductPrice::class, function (Faker $faker) {
    return [
        'qty' => $faker->numberBetween(100, 1000),
        'price' => $faker->numberBetween(300000, 120000),
        'lead_time' => $faker->numberBetween(7, 45)
    ];
});
