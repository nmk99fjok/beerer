<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Review;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Review::class, function (Faker $faker) {
    return [
        'rating' => $faker->numberBetween($min = 1, $max = 5),
        'body' => $faker->text(),
    ];
});
