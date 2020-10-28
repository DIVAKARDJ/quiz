<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\HomeSlider;
use Faker\Generator as Faker;

$factory->define(HomeSlider::class, function (Faker $faker) {

    return [
        'image'      => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
    ];
});
