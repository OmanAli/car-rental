<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarType extends Model
{
        protected $table = 'car_types';
        protected $guarded = [];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
