<?php

namespace App\Models;

use App\Support\PartnerLogoStorage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SupervisorPartner extends Model
{
    protected $fillable = ['supervisor_id', 'category_id', 'company_name', 'description', 'phone', 'whatsapp', 'price', 'offers', 'logo_path'];

    public function getLogoUrlAttribute(): ?string
    {
        return PartnerLogoStorage::url($this->logo_path);
    }

    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(PartnerCategory::class, 'category_id');
    }
}
