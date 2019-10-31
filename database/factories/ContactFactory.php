<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Contact;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
    $genders = ['Male', 'Female'];
    $randGender = $faker->numberBetween(0, 1);
    return [
        "name" => $faker->name(),
        "phone" => $faker->tollFreePhoneNumber(),
        "email" => $faker->email(),
        "description" => $faker->sentence(),
        "gender" => $genders[$randGender]
    ];
});
