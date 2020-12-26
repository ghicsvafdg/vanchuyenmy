<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductCategory;
// use App\Models\ProductCategory as AppProductCategory;
use Faker\Generator as Faker;

$factory->define(ProductCategory::class, function (Faker $faker) {
    $title=$faker->sentence($nbWords = 3, $variableNbWords = true);
    return [

        'title'=>$title,
        'slug'=>$title,
        'parent_id'=>$faker->numberBetween($min = 0, $max = 1) // 8567
    ];
});
