<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Brands;
use Faker\Generator as Faker;

$factory->define(Brands::class, function (Faker $faker) {
    return [
        'name'=>$faker->name()
    ];
});
