<?php

namespace App\Models;

use App\Enums\UserRole;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'father_name',
        'grandfather_name',
        'email',
        
        'phone',
        'country',
        'role',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'role'              => UserRole::class,
        ];
    }

    // ── Role helpers ──────────────────────────────────────────────────────

    public function isAdmin(): bool      { return $this->role === UserRole::Supervisor; }
    public function isSupervisor(): bool { return $this->role === UserRole::Supervisor; }
    public function isManager(): bool    { return $this->role === UserRole::Manager; }
    public function isAgent(): bool      { return $this->role === UserRole::Agent; }
    public function isOwner(): bool      { return $this->role === UserRole::Owner; }
    public function isPartner(): bool    { return $this->role === UserRole::Partner; }
    public function isOfficiant(): bool  { return $this->role === UserRole::Officiant; }
    public function isUser(): bool       { return $this->role === UserRole::User; }

    // ── Relationships ─────────────────────────────────────────────────────

    public function halls(): HasMany
    {
        return $this->hasMany(Hall::class, 'owner_id');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(HallBooking::class, 'user_id');
    }

    public function refCode(): HasOne
    {
        return $this->hasOne(AgentRefCode::class, 'agent_id');
    }

    public function referrals(): HasMany
    {
        return $this->hasMany(Referral::class, 'agent_id');
    }

    public function partnerProfile(): HasOne
    {
        return $this->hasOne(Partner::class, 'user_id');
    }

    public function officiantProfile(): HasOne
    {
        return $this->hasOne(Officiant::class, 'user_id');
    }
}

