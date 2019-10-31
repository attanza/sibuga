<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {

    $random = $faker->numberBetween(1, 2);
    $category = $random === 1 ? 'Vendor' : 'Customer';
    return [
        'name' => $faker->company,
        'category' => $category,
        'email' => $faker->email,
        'phone' => $faker->e164PhoneNumber,
        'address' => $faker->address,
        'description' => $faker->sentence()
    ];
});
