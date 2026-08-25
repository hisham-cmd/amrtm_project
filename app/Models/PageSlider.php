<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PageSlider extends Model
{
    protected $fillable = [
        'title', 'subtitle', 'image_path', 'link_url', 'link_text', 'is_active', 'sort_order',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function getImageUrlAttribute(): ?string
    {
        return $this->image_path ? Storage::disk('public')->url($this->image_path) : null;
    }

    public function scopeActive($q) { return $q->where('is_active', true)->orderBy('sort_order'); }
}
