<?php

namespace App\Models;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;

    protected $fillable = ['series_name', 'brand', 'produced_at', 'country_id', 'length', 'width', 'height', 'weight', 'payload', 'seat', 'output'];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function series()
    {
        return $this->hasMany(Car::class, 'series_id');
    }

}
