<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubDistrict extends Model
{
    use HasFactory;

    protected $guarded = [];

     // for SubDistrict table one to one relation
    public function district(){
        return $this->belongsTo(District::class);
    }

}
