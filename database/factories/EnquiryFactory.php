<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Enquiry;
use Faker\Generator as Faker;

$factory->define(Enquiry::class, function(Faker $faker)
{
    return [
        'type'          => $faker->randomElement(AppHelper::keys('enquiry_types')),
        'firm'          => $faker->company,
        'first_name'    => $faker->firstName,
        'last_name'     => $faker->lastName,
        'email'         => $faker->safeEmail,
        'phone_number'  => $faker->tollFreePhoneNumber,
        'message'       => $faker->paragraphs(3, true),
        'file'          => $faker->imageUrl($width = 640, $height = 480),
    ];
});
