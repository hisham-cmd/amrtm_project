<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Referral extends Model
{
    protected $fillable = [
        'agent_id', 'user_id', 'hall_id', 'booking_id',
        'ref_code', 'source',
        'commission_rate', 'commission_amount',
        'status', 'confirmed_by', 'confirmed_at', 'notes',
    ];

    protected $casts = [
        'confirmed_at'      => 'datetime',
        'commission_rate'   => 'decimal:2',
        'commission_amount' => 'decimal:2',
    ];

    public function agent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function hall(): BelongsTo
    {
        return $this->belongsTo(Hall::class);
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(HallBooking::class, 'booking_id');
    }

    public function confirmedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }
}
