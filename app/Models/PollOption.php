<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'poll_id',
        'option_text_bn',
        'option_text_en',
        'image',
        'votes_count'
    ];

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function votes()
    {
        return $this->hasMany(PollVote::class);
    }

    public function getPercentage()
    {
        $totalVotes = $this->poll->getTotalVotes();
        if ($totalVotes == 0) {
            return 0;
        }
        return round(($this->votes_count / $totalVotes) * 100);
    }

    public function getOptionText()
    {
        return app()->getLocale() == 'bn' ? $this->option_text_bn : $this->option_text_en;
    }
}
