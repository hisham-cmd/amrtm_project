<?php

namespace App\Models;

use App\Support\PartnerLogoStorage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HallPartner extends Model
{
    protected $fillable = ['hall_id', 'company_name', 'logo_path'];

    public function getLogoUrlAttribute(): ?string
    {
        return PartnerLogoStorage::url($this->logo_path);
    }

    public function hall(): BelongsTo
    {
        return $this->belongsTo(Hall::class);
    }
}
