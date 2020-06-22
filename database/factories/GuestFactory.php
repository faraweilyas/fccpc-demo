<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Guest;
use Faker\Generator as Faker;

$factory->define(Guest::class, function(Faker $faker)
{
    return [
        'ip_address'        => $faker->ipv4,
        'tracking_id'       => SerialNumber::trackingId(),
        'email'             => $faker->unique()->safeEmail,
    ];
});
