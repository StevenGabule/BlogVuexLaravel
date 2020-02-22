<?php

use Faker\Generator as Faker;
use App\Model\Like;
use App\Model\Reply;
use App\User;
$factory->define(Like::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return User::all()->random();
        },
        'reply_id' => function() {
            return Reply::all()->random();
        },
    ];
});
