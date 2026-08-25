<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PartnerCategory extends Model
{
    protected $fillable = ['supervisor_id', 'name'];

    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    public function partners(): HasMany
    {
        return $this->hasMany(Partner::class, 'category_id');
    }

    public function simplePartners(): HasMany
    {
        return $this->hasMany(Partner::class, 'category_id')->where('type', 'simple');
    }
}
