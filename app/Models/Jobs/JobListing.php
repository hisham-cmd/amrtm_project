<?php

namespace App\Models\Jobs;

use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    protected $connection = 'job_listings';

    protected $table = 'jobs';

    protected $fillable = [
        'company_id', 'title', 'job_main_type', 'description', 'job_category', 'job_type',
        'experience_level', 'location', 'salary_min', 'salary_max',
        'required_skills', 'languages', 'positions_available', 'benefits',
        'status', 'deadline'
    ];

    protected $casts = [
        'required_skills' => 'array',
        'languages'        => 'array',
        'benefits'         => 'array',
        'deadline'         => 'datetime',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'job_id');
    }
}
