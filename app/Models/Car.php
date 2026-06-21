<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = 'cars';
    protected $guarded = [];

    public function carType()
    {
        return $this->belongsTo(CarType::class);
    }
}
