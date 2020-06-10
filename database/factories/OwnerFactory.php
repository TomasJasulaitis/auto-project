<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Owner;
use App\Truck;
use Faker\Generator as Faker;

$factory->define(Owner::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName(),
        'truck_id' => function () use ($faker) {
            if (Truck::count())
                return $faker->randomElement(Truck::pluck('id')->toArray());
            else return factory(Truck::class)->create()->id;
        },
    ];
});
