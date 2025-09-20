<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BandwidthUsage extends Model
{
    use HasFactory;

    protected $fillable = ['month', 'used_gb', 'daily_data'];

    protected $casts = [
        'daily_data' => 'array',
    ];
}
