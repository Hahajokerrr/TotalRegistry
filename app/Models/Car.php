<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    public function owner()
    {
        return $this->morphTo();
    }

    public function series()
    {
        return $this->belongsTo(Series::class, 'series_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function listing()
    {
        return $this->hasMany(Listing::class, 'car_id');
    }

}
