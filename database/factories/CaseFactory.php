<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Cases;
use App\Models\Guest;
use Faker\Generator as Faker;

$factory->define(Cases::class, function(Faker $faker)
{
    $randomParties  = [$faker->company, $faker->company, $faker->company, $faker->company, $faker->company];
    $parties        = implode(':', $faker->randomElements($randomParties, rand(1, 5)));
    return [
        'user_id'                   => factory(User::class),
        'guest_id'                  => factory(Guest::class),
        'reference_number'          => SerialNumber::referenceNumber(),
        'subject'                   => $faker->paragraph,
        'parties'                   => $parties,
        'case_category'             => $faker->randomElement(AppHelper::keys('case_categories')),
        'case_type'                 => $faker->randomElement(AppHelper::keys('case_types')),
        'applicant_firm'            => $faker->company,
        'applicant_first_name'      => $faker->firstName,
        'applicant_last_name'       => $faker->lastName,
        'applicant_email'           => $faker->safeEmail,
        'applicant_phone_number'    => $faker->tollFreePhoneNumber,
        'applicant_address'         => $faker->address,
    ];
});
