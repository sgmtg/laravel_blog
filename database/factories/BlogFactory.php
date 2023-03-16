<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Blog; //ModelをModels\Blogに変更
use Faker\Generator as Faker;


$factory->define(Blog::class, function (Faker $faker) { // ModelをBlogに変更
    return [
        'title' => $faker->word, // wordは一単語
        'content' => $faker->realText // realTextは小説の一説
    ];
});
