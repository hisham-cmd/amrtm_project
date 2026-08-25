<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FranchiseBrandImage extends Model
{
    protected $table = 'franchise_brand_images';

    protected $fillable = ['brand_id', 'path', 'caption', 'sort_order', 'is_primary'];

    protected $casts = ['is_primary' => 'boolean'];

    public function getUrlAttribute(): string
    {
        return Storage::disk('public')->url($this->path);
    }
}
