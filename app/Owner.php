<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{

    protected $fillable = [
        'first_name',
        'last_name',
        'truck_id',
    ];

    public function truck()
    {
        return $this->belongsTo(Truck::class);
    }

    /**
     * Get the user's full concatenated name.
     * -- Must postfix the word 'Attribute' to the function name
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
