<?php

use App\TruckModel;
use Illuminate\Database\Seeder;

class TruckModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach (['Volvo', 'VAZ', 'Mercedes', 'GAZ'] as $truckModel) {
            TruckModel::insert([
                ['title' => $truckModel],
            ]);
        }
    }
}
