<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Checklist;
use Faker\Generator as Faker;
use App\Models\ChecklistGroup;

$factory->define(Checklist::class, function (Faker $faker) {
    return [
        'group_id'  => factory(ChecklistGroup::class),
        'name'      => $faker->sentence(rand(6, 10)),
    ];
});
