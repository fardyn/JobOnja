<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Job extends Model
{
    use HasFactory;
    protected $table = 'job_listing';
    protected $fillable = [
        "title",
        "description",
        'salary',
        'tags',
        'job_type',
        'remote',
        'requirement',
        'benefits',
        'city',
        'address',
        'zipcode',
        'contact_name',
        'contact_phone',
        'company_name',
        'company_description',
        'company_logo',
        'company_website'];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }
}

