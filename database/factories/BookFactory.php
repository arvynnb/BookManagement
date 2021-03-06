<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

$factory->define(App\Models\Book::class, function (Faker $faker) {
    return [
        'title'         => $faker->word,
        'author'        => $faker->name,
        'description'   => $faker->sentence,
        'image'         =>  '',
        'quantity'      => $faker->numberBetween(20, 200),
    ];
});