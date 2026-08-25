<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'phone', 'password',
        'role', 'avatar', 'balance', 'is_active',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
        'balance'           => 'decimal:2',
        'is_active'         => 'boolean',
    ];

    /* ── Relations ── */
    public function requests()
    {
        return $this->hasMany(ServiceRequest::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /* ── Helpers ── */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function getAvatarUrlAttribute(): string
    {
        return $this->avatar
            ? asset('storage/' . $this->avatar)
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=1A237E&color=fff&size=128';
    }

    public function totalRequests(): int
    {
        return $this->requests()->count();
    }

    public function completedRequests(): int
    {
        return $this->requests()->where('status', 'done')->count();
    }
}
