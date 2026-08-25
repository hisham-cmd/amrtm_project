<?php

namespace App\Models\Jobs;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class JobUser extends Authenticatable
{
    use Notifiable;

    protected $connection = 'job_listings';

    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'phone', 'user_type', 'password', 'avatar', 'is_active'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function company()
    {
        return $this->hasOne(Company::class, 'user_id');
    }

    public function jobSeeker()
    {
        return $this->hasOne(JobSeeker::class, 'user_id');
    }
}
