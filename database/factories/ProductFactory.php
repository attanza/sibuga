<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $buyPrice = $faker->numberBetween(30000, 300000);
    return [
        'code' => 'SBGP'.$faker->ean8(),
        'name' => $faker->word(),
        'stock' => $faker->numberBetween(10, 100),
        'weight' => $faker->numberBetween(1, 3),
        'lead_time' => $faker->numberBetween(1, 3),
        'buy_price' => $buyPrice,
        'sell_price' => $buyPrice + (0.3 * $buyPrice),
        'description' => $faker->sentence(),
    ];
});
