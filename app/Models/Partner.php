<?php

namespace App\Models;

use App\Support\PartnerLogoStorage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Partner extends Model
{
    protected $fillable = [
        'user_id', 'added_by', 'type', 'entity_type', 'category_id', 'company_name', 'description',
        'city', 'country', 'commercial_reg_number', 'unified_number', 'address', 'building_number', 'street', 'floor', 'office_number',
        'phone', 'venue_phone', 'venue_email', 'user_phone', 'whatsapp', 'website', 'logo_path', 'cover_path', 'status', 'admin_note',
        // Manager
        'manager_first_name', 'manager_father_name', 'manager_grandfather_name', 'manager_phone',
        // System representative
        'rep_first_name', 'rep_father_name', 'rep_grandfather_name',
    ];

    // ── Accessors ─────────────────────────────────────────────────────────

    public function getLogoUrlAttribute(): ?string
    {
        if (! $this->logo_path) {
            return null;
        }
        // Simple partners: logo stored in partner_logos disk (via PartnerLogoStorage)
        // Account partners: logo stored in public disk
        if ($this->type === 'simple') {
            return PartnerLogoStorage::url($this->logo_path);
        }
        return route('public.storage', ['path' => $this->logo_path]);
    }

    public function getCoverUrlAttribute(): ?string
    {
        return $this->cover_path ? Storage::disk('public')->url($this->cover_path) : null;
    }

    public function getIsActiveAttribute(): bool
    {
        return $this->status === 'active';
    }

    // ── Relationships ─────────────────────────────────────────────────────

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(PartnerCategory::class, 'category_id');
    }

    public function media(): HasMany
    {
        return $this->hasMany(PartnerMedia::class)->orderBy('sort_order');
    }

    public function services(): HasMany
    {
        return $this->hasMany(PartnerService::class)->orderBy('sort_order');
    }

    public function verificationDocuments(): HasMany
    {
        return $this->hasMany(\App\Models\HallVerificationDocument::class, 'owner_id', 'user_id');
    }
}
