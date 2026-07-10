<?php

namespace App\Models;

use Carbon\Carbon;
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

    /**
     * Billable rental days (same-day rentals count as 1 day).
     */
    public function getDaysAttribute(): int
    {
        return max(1, Carbon::parse($this->pickup_date)->diffInDays($this->drop_date));
    }

    /**
     * Revenue for this rental (rate per day x days).
     */
    public function getAmountAttribute(): float
    {
        return $this->car ? (float) $this->car->rental_price_per_day * $this->days : 0.0;
    }
}
