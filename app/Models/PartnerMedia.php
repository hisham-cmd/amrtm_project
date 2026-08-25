<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class PartnerMedia extends Model
{
    protected $fillable = ['partner_id', 'file_path', 'sort_order'];

    public function getUrlAttribute(): string
    {
        return route('public.storage', ['path' => $this->file_path]);
    }

    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }
}
