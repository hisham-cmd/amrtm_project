<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HallMedia extends Model
{
    protected $fillable = ['hall_id', 'file_path', 'sort_order'];

    public function hall(): BelongsTo
    {
        return $this->belongsTo(Hall::class);
    }
}
