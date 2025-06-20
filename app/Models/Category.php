<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{

    use HasFactory;

    protected $guarded = [];

    // for SubCategory table one to one relation
    public function subCate(){
        return $this->hasOne(SubCategory::class);
    }

    // for news table one to one relation
    public function newsCate(){
        return $this->hasOne(News::class);
    }

}