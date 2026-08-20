<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = 'cars';
    protected $guarded = [];

    public function images()
    {
        return $this->hasMany(CarImage::class)->orderBy('sort_order')->orderBy('id');
    }
}
