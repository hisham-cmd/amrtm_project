<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'order_number', 'user_id', 'total_amount',
        'status', 'payment_method', 'receipt_path', 'bank_info_snapshot', 'admin_notes',
    ];

    protected function casts(): array
    {
        return [
            'total_amount'       => 'decimal:2',
            'bank_info_snapshot' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending_payment'   => 'بانتظار الدفع',
            'receipt_uploaded'  => 'تم رفع الإيصال',
            'confirmed'         => 'مؤكد',
            'rejected'          => 'مرفوض',
            default             => $this->status,
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'pending_payment'   => '#d97706',
            'receipt_uploaded'  => '#2563eb',
            'confirmed'         => '#16a34a',
            'rejected'          => '#dc2626',
            default             => '#6c7a72',
        };
    }
}
