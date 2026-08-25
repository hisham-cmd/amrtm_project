<?php

namespace App\Models\Jobs;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $connection = 'job_listings';

    protected $table = 'reviews';

    protected $fillable = [
        'company_id', 'job_seeker_id', 'rating', 'comment'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class, 'job_seeker_id');
    }
}
