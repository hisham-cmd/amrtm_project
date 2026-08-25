<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id', 'item_type', 'item_id',
        'label', 'price_snapshot', 'event_date', 'notes',
    ];

    protected function casts(): array
    {
        return [
            'price_snapshot' => 'decimal:2',
            'event_date'     => 'date',
        ];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function getTypeIconAttribute(): string
    {
        return match ($this->item_type) {
            'hall'    => 'fa-building',
            'service' => 'fa-handshake',
            default   => 'fa-tag',
        };
    }

    public function getTypeLabelAttribute(): string
    {
        return match ($this->item_type) {
            'hall'    => 'قاعة',
            'service' => 'خدمة',
            default   => '',
        };
    }
}
