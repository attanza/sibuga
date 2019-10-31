<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    return [
        'code'=> 'SBGPR'.$faker->ean8(),
        'title'=> $faker->sentence(),
        'start_date'=> $faker->date(),
        'end_date'=> $faker->date(),
        'amount' => $faker->numberBetween(10000000, 50000000)
    ];
});
