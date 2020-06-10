<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'content',
        'truck_id',
    ];

    public function truck()
    {
        return $this->belongsTo(Truck::class);
    }
}
