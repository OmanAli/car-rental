<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class RentDetail extends Model
{
    /**
     * SiteSetting key holding the single site-wide veteran discount percentage.
     */
    public const VETERAN_DISCOUNT_SETTING_KEY = 'discounts.veteran_percentage';

    protected $fillable = [
        'user_id',
        'car_id',
        'coupon_id',
        'veteran_id',
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

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
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

    /**
     * "Coupon" or "Veteran ID" — whichever discount (if any) was used for this rental.
     */
    public function getDiscountTypeAttribute(): ?string
    {
        if ($this->coupon) {
            return 'Coupon';
        }

        if ($this->veteran_id) {
            return 'Veteran ID';
        }

        return null;
    }

    /**
     * The coupon code or veteran ID that earned the discount, if any.
     */
    public function getDiscountReferenceAttribute(): ?string
    {
        if ($this->coupon) {
            return $this->coupon->code;
        }

        return $this->veteran_id;
    }

    /**
     * The discount percentage applied — the coupon's own percentage, or the single
     * site-wide veteran discount percentage when a veteran ID was provided.
     */
    public function getDiscountPercentAttribute(): float
    {
        if ($this->coupon) {
            return (float) $this->coupon->percentage;
        }

        if ($this->veteran_id) {
            return (float) SiteSetting::getValue(self::VETERAN_DISCOUNT_SETTING_KEY, '0');
        }

        return 0.0;
    }

    /**
     * Rent after applying the coupon or veteran discount, if one was used.
     */
    public function getDiscountedAmountAttribute(): float
    {
        if ($this->discount_percent <= 0) {
            return $this->amount;
        }

        return round($this->amount - ($this->amount * $this->discount_percent / 100), 2);
    }
}
