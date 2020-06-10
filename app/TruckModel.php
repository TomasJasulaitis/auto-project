<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TruckModel extends Model
{
    public function truck()
    {
        return $this->hasOne(Truck::class);
    }
}
