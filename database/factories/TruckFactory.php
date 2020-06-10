<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Truck;
use App\TruckModel;
use Faker\Generator as Faker;

$factory->define(Truck::class, function (Faker $faker) {
    return [

        'model_id' => function () use ($faker) {
            if (TruckModel::count())
                return $faker->randomElement(TruckModel::pluck('id')->toArray());
            else return factory(TruckModel::class)->create()->id;
        },
        'manufacture_date' => $faker->dateTimeBetween($startDate = '-100 years', $endDate = 'now')->format('Y'),
        'owner_count' => $faker->randomNumber(),
    ];
});
