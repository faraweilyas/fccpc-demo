<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Faq;
use App\Models\Feedback;
use Faker\Generator as Faker;

$factory->define(Feedback::class, function(Faker $faker)
{
    return [
        'faq_id'        => factory(Faq::class),
        'ip_address'    => $faker->ipv4,
        'feedback'      => $faker->randomElement(AppHelper::values('feedbacks', 'strtolower')),
    ];
});
