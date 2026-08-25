<?php

namespace App\Models\Jobs;

use Illuminate\Database\Eloquent\Model;

class JobSeeker extends Model
{
    protected $connection = 'job_listings';

    protected $table = 'job_seekers';

    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'seeker_type', 'bio', 'cv', 'phone',
        'location', 'experience_level', 'skills', 'languages', 'job_title',
        'expected_salary_min', 'expected_salary_max', 'job_type', 'about','desired_specialization'
    ];

    protected $casts = [
        'skills'    => 'array',
        'languages' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(JobUser::class, 'user_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'job_seeker_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'job_seeker_id');
    }
}
