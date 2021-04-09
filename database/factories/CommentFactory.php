<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Comments;
use App\Models\Items;
use App\User;
use Faker\Generator as Faker;


$factory->define(Comments::class, function (Faker $faker) {
    return [ 
        'comment' => $faker->word(),
        'item_id' => factory(Items::class),
        'user_id' => factory(User::class),
    ];
});
