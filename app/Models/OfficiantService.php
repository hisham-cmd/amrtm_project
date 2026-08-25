<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OfficiantService extends Model
{
    protected $fillable = ['officiant_id', 'title', 'description', 'price', 'sort_order'];

    protected $casts = ['price' => 'decimal:2'];

    public function officiant(): BelongsTo
    {
        return $this->belongsTo(Officiant::class);
    }
}
