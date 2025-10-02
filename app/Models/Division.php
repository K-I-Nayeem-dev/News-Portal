<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $guarded = [];

    // for District table one to one relation
    public function getDistrict()
    {
        return $this->hasOne(District::class);
    }

    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
