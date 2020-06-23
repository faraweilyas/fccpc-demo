<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Faq;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Faq::class, function(Faker $faker)
{
    return [
        'user_id'   => factory(User::class),
        'category'  => $faker->randomElement(AppHelper::keys('faq_categories')),
        'slug'      => $faker->slug,
        'question'  => $faker->paragraph,
        'answer'    => $faker->paragraphs(5, true),
    ];
});
