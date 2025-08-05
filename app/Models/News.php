<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{

    use HasFactory;

    protected $guarded = [];

    // Category relationship (One-to-One)
    public function newsCategory()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // SubCategory relationship (One-to-One)
    public function newsSubCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_cate_id');
    }

    // Category relationship (One-to-One)
    public function newsDivision()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    // Category relationship (One-to-One)
    public function newsDistrict()
    {
        return $this->belongsTo(District::class, 'dist_id');
    }

    // SubCategory relationship (One-to-One)
    public function newsSubDist()
    {
        return $this->belongsTo(SubDistrict::class, 'sub_dist_id');
    }

    // User relationship (One-to-One)
    public function newsUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function editUser()
    {
        return $this->belongsTo(User::class, 'update_by_user');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
