<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purpose extends Model
{
    use HasFactory;

    public function purpose()
    {
        return $this->hasMany(Car::class, 'purpose_id');
    }
}
