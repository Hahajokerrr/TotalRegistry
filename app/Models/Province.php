<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    // protected $fillable = ['province_name'];

    public function province()
    {
        return $this->hasMany(\App\Models\Car::class, 'province_id');
    }

    public function districts()
    {
        return $this->hasMany(\App\Models\District::class, 'province_id');
    }

    public function user()
    {
        return $this->hasMany(\App\Models\User::class, 'province_id');
    }

    public function administrativeRegion()
    {
        return $this->belongsTo(\App\Models\AdministrativeRegion::class, 'administrative_region_id');
    }
}
