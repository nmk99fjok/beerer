<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Article;
use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;

//Articleモデル用のファクトリ

$factory->define(Article::class, function (Faker $faker) {

    $file = UploadedFile::fake()->image('beer.jpg');
    $path = $file->store('public/images');
    $imagename = basename($path);

    return [
        'title' => $faker->word,
        'maker' => $faker->company,
        'price' => $faker->numberBetween($min = 100, $max = 1000),
        'body' => $faker->text(),
        'image' => $imagename,
    ];
});
