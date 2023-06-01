<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function companies()
    {
        return $this->hasMany(Company::class, 'ward_id');
    }

    public function people()
    {
        return $this->hasMany(Person::class, 'ward_id');
    }
}
