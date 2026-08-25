<?php

namespace App\Models\Jobs;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = 'applications';

    protected $fillable = [
        // ── النوع ──
        'application_type',

        // ── طلب عادي ──
        'job_id', 'job_seeker_id', 'cover_letter', 'cv',
        'status', 'reviewed_at', 'rejection_reason',

        // ── طلب كوادر — خطوة 1 ──
        'first_name', 'last_name', 'birth_date', 'gender',
        'phone', 'email', 'nationality',

        // ── خطوة 2 ──
        'passport_number', 'passport_expiry', 'passport_country',

        // ── خطوة 3 ──
        'photo', 'certificate', 'education_level', 'specialization',

        // ── خطوة 4 ──
        'origin_country', 'target_countries', 'job_title_desired',
        'desired_job_type', 'expected_salary_min', 'expected_salary_max', 'notes',
     'country', 'city', 'father_name', 'country_code', 'work_country',
    ];

    protected $casts = [
        'birth_date'       => 'date',
        'passport_expiry'  => 'date',
        'reviewed_at'      => 'datetime',
        'target_countries' => 'array',
    ];

    // ── العلاقات ──
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class);
    }

    // ── Scopes مساعدة ──
    public function scopeCadres($query)
    {
        return $query->where('application_type', 'cadres');
    }

    public function scopeRegular($query)
    {
        return $query->where('application_type', 'job');
    }

    // ── Accessors ──
    public function getFullNameAttribute(): string
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

    public function isCadres(): bool
    {
        return $this->application_type === 'cadres';
    }
}
