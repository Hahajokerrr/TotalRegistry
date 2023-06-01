<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdministrativeRegion extends Model
{
    use HasFactory;

    public function administrativeRegion()
    {
        return $this->hasMany(Province::class, 'administrative_region_id');
    }
}
