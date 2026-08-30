<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class HomepageSlide extends Model
{
    protected $table = 'homepage_slides';

    protected $fillable = [
        'title', 'image_path', 'link_url', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image_path) {
            return null;
        }

        return $this->isLocalPath()
            ? asset($this->image_path)
            : Storage::disk('public')->url($this->image_path);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    private function isLocalPath(): bool
    {
        return str_starts_with($this->image_path, 'images/')
            || str_starts_with($this->image_path, 'uploads/');
    }
}
