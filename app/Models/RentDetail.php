<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentDetail extends Model
{
    protected $fillable = [
        'user_id',
        'car_id',
        'pickup_date',
        'drop_date',
        'delivery_type',
        'delivery_location',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
