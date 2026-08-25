<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HallFeature extends Model
{
    protected $fillable = ['hall_id', 'name', 'icon'];

    public function hall(): BelongsTo
    {
        return $this->belongsTo(Hall::class);
    }
}
