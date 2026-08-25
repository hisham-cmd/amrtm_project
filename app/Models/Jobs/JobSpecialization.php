<?php

namespace App\Models\Jobs;

use Illuminate\Database\Eloquent\Model;

class JobSpecialization extends Model
{
    protected $connection = 'job_listings';

    protected $fillable = [
        'seeker_type',
        'title',
        'icon',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /* ── Scope: فقط النشطة ── */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /* ── Scope: حسب النوع ── */
    public function scopeOfType($query, string $type)
    {
        return $query->where('seeker_type', $type);
    }
}
