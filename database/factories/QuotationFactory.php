<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Quotation;
use Faker\Generator as Faker;

$factory->define(Quotation::class, function (Faker $faker) {
    return [
        'no'=> 'SBGQ'.$faker->ean8(),
        'title'=> $faker->sentence(),
        'terms'=> $faker->sentence(),
        'description'=> $faker->sentence(),
    ];
});
