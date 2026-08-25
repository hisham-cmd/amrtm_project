<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Officiant extends Model
{
    protected $fillable = [
        'user_id',
        'license_number',
        'working_hours',
        'bank_account',
        'iban',
        'city',
        'country',
        'neighborhood',
        'street',
        'address',
        'bio',
        'profile_photo',
        'cover_photo',
        'phone',
        'manager_first_name',
        'manager_father_name',
        'manager_grandfather_name',
        'manager_phone',
        'rep_first_name',
        'rep_father_name',
        'rep_grandfather_name',
        'status',
        'admin_note',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function verificationDocuments(): HasMany
    {
        return $this->hasMany(HallVerificationDocument::class, 'owner_id', 'user_id');
    }

    public function media(): HasMany
    {
        return $this->hasMany(OfficiantMedia::class)->orderBy('sort_order');
    }

    public function services(): HasMany
    {
        return $this->hasMany(OfficiantService::class)->orderBy('sort_order');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(OfficiantBooking::class)->latest();
    }

    public function getIsActiveAttribute(): bool
    {
        return $this->status === 'active';
    }

    public function getProfilePhotoUrlAttribute(): ?string
    {
        return $this->profile_photo
            ? route('public.storage', ['path' => $this->profile_photo])
            : null;
    }
}
