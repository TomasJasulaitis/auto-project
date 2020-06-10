<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use App\Truck;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->realText($faker->numberBetween(10, 50)),
        'truck_id' => function () use ($faker) {
            if (Truck::count())
                return $faker->randomElement(Truck::pluck('id')->toArray());
            else return factory(Truck::class)->create()->id;
        },
    ];
});
