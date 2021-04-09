<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Items;
use App\Models\Orders;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Orders::class, function (Faker $faker) {
    return [
        'bank_transaction_id' => Str::random(60),
        'item_id'             => factory(Items::class),
        'user_id'             => factory(User::class),
        'total_amount'        => 2000,
    ];
});
