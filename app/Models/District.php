<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $guarded = [];


    // for SubDistrict table one to one relation
    public function subDist()
    {
        return $this->hasOne(SubDistrict::class);
    }

    // for get Divisoin table one to one relation

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function subdistricts()
    {
        return $this->hasMany(SubDistrict::class);
    }



    // for news table one to one relation
    public function newsDist()
    {
        return $this->hasOne(News::class);
    }
}
