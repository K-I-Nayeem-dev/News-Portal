<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Poll extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_bn',
        'question_en',
        'image',
        'expires_at',
        'created_by',
        'is_active',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function options()
    {
        return $this->hasMany(PollOption::class);
    }

    public function votes()
    {
        return $this->hasMany(PollVote::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Helper Methods
    public function isExpired()
    {
        return Carbon::now()->isAfter($this->expires_at);
    }

    public function hasIpVoted($ipAddress)
    {
        return $this->votes()->where('ip_address', $ipAddress)->exists();
    }

    public function getTotalVotes()
    {
        return $this->votes()->count();
    }

    public function getQuestion()
    {
        return app()->getLocale() == 'bn' ? $this->question_bn : $this->question_en;
    }
}
