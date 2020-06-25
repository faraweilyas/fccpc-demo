<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Cases;
use App\Models\Document;
use Faker\Generator as Faker;

$factory->define(Document::class, function(Faker $faker)
{
    return [
        'case_id'           => factory(Cases::class),
        'group'             => $faker->randomElement(AppHelper::keys('file_groups')),
        'document_name'     => $faker->words(3, true),
        'file'              => $faker->imageUrl($width = 640, $height = 480),
        'additional_info'   => $faker->paragraphs(1, true),
    ];
});
