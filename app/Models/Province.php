<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $fillable = ['province_name'];

    public function province()
    {
        return $this->hasMany(Car::class, 'province_id');
    }
}
