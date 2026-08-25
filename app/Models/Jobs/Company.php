<?php

namespace App\Models\Jobs;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $connection = 'job_listings';

    protected $table = 'companies';

    protected $fillable = [
        'user_id', 'company_name', 'company_type', 'logo', 'description', 'website',
        'industry', 'employee_count', 'location', 'phone',
        'hr_contact_name', 'hr_contact_email', 'company_details', 'is_verified','transfer_reasons', 'transfer_notes'
    ];
protected $casts = [
        'transfer_reasons' => 'array', 
        'is_verified'      => 'boolean',
    ];
    public function user()
    {
        return $this->belongsTo(JobUser::class, 'user_id');
    }

    public function jobs()
    {
        return $this->hasMany(JobListing::class, 'company_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'company_id');
    }
}
