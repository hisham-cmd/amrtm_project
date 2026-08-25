<?php

namespace App\Models;

use App\Enums\BookingStatus;
use App\Enums\OccasionType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HallBooking extends Model
{
    protected $fillable = [
        'hall_id', 'user_id', 'owner_name', 'booking_date',
        'occasion_type', 'guests_count', 'tables_count', 'notes', 'status', 'total_price',
        'payment_method', 'payment_contact', 'payment_email', 'payment_reference', 'payment_status',
    ];

    protected function casts(): array
    {
        return [
            'booking_date'  => 'date',
            'occasion_type' => OccasionType::class,
            'status'        => BookingStatus::class,
        ];
    }

    public function hall(): BelongsTo
    {
        return $this->belongsTo(Hall::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
