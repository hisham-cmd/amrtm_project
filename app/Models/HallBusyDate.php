<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HallBusyDate extends Model
{
    protected $fillable = ['hall_id', 'busy_date', 'reason'];

    protected function casts(): array
    {
        return [
            'busy_date' => 'date',
        ];
    }

    public function hall(): BelongsTo
    {
        return $this->belongsTo(Hall::class);
    }
}
