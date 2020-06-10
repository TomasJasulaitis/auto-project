<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    protected $fillable = [
        'model_id',
        'manufacture_date',
        'owner_count',
    ];

    public function owner()
    {
        return $this->hasOne(Owner::class);
    }
    public function model()
    {
        return $this->belongsTo(TruckModel::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
