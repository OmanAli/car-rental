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
        'rental_type',
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
     * Billable weeks for weekly-type rentals (any partial week rounds up to a full week).
     */
    public function getWeeksAttribute(): int
    {
        return (int) ceil($this->days / 7);
    }

    /**
     * Human-readable label for the rental type (Daily, Weekly, Uber/Lyft Weekly),
     * including the day/week count that was actually billed.
     */
    public function getRentalTypeLabelAttribute(): string
    {
        return match ($this->rental_type) {
            'weekly' => 'Weekly (' . $this->weeks . ' week' . ($this->weeks > 1 ? 's' : '') . ')',
            'uber_lyft_weekly' => 'Uber/Lyft Weekly (' . $this->weeks . ' week' . ($this->weeks > 1 ? 's' : '') . ')',
            default => 'Daily (' . $this->days . ' day' . ($this->days > 1 ? 's' : '') . ')',
        };
    }

    /**
     * Revenue for this rental — the daily rate x days, or the weekly / Uber-Lyft weekly
     * rate x the number of weeks billed (any partial week rounds up), depending on the
     * rental type chosen at booking time.
     */
    public function getAmountAttribute(): float
    {
        if (!$this->car) {
            return 0.0;
        }

        return match ($this->rental_type) {
            'weekly' => (float) ($this->car->weekly_rate ?? 0) * $this->weeks,
            'uber_lyft_weekly' => (float) ($this->car->uber_lyft_weekly_rate ?? 0) * $this->weeks,
            default => (float) $this->car->rental_price_per_day * $this->days,
        };
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
