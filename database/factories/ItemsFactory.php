<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Brands;
use App\Models\Category;
use App\Models\Items;
use App\User;
use Faker\Generator as Faker;

$factory->define(Items::class, function (Faker $faker) {
    return [
        'name'        => $faker->name,
        'description' => $faker->paragraph(1),
        'condition'   => $faker->word(),
        'price'       => $faker->numberBetween(1000,5000),
        'category_id' => factory(Category::class),
        'brand_id'    => factory(Brands::class),
        'photo'       => 'https://via.placeholder.com/150',
        'users_id'    => factory(User::class),
        'slug'        => $faker->unique()->name,
        'date'        => now(),
    ];
});
