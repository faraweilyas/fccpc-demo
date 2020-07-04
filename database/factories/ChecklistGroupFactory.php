<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\ChecklistGroup;

$factory->define(ChecklistGroup::class, function(Faker $faker)
{
    return [
        'name'      => $faker->sentence,
        'label'     => $faker->words(3, true),
    ];
});
