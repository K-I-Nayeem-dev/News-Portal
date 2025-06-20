<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    // for category table one to one relation
    public function category(){
        return $this->belongsTo(Category::class);
    }

    // for NewsSubCate table one to one relation
    public function newsSubCate(){
        return $this->hasOne(News::class);
    }




}
