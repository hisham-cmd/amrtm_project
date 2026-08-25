<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    protected $fillable = [
        'cart_id', 'item_type', 'item_id',
        'label', 'price_snapshot', 'event_date', 'notes',
    ];

    protected function casts(): array
    {
        return [
            'price_snapshot' => 'decimal:2',
            'event_date'     => 'date',
        ];
    }

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    /** Resolve the real item (Hall or PartnerService) */
    public function resolveItem(): Hall|PartnerService|null
    {
        return match ($this->item_type) {
            'hall'    => Hall::find($this->item_id),
            'service' => PartnerService::find($this->item_id),
            default   => null,
        };
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
