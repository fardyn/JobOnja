<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class applicants extends Model
{
    protected $fillable = [
        'user_id',
        'job_id',
        'resume_path',
        'email',
        'full_name',
        'contact_number',
        'message',
        'location'
    ];

    public function job() : belongsTo {
        return $this->belongsTo(Job::class);
    }

    public function user() : belongsTo {
        return $this->belongsTo(User::class);
    }

}
