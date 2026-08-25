<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OfficiantBooking extends Model
{
    protected $fillable = [
        'user_id', 'officiant_id', 'officiant_service_id',
        'event_date', 'phone', 'notes', 'status',
    ];

    protected $casts = ['event_date' => 'date'];

    public function user(): BelongsTo      { return $this->belongsTo(User::class); }
    public function officiant(): BelongsTo { return $this->belongsTo(Officiant::class); }
    public function service(): BelongsTo   { return $this->belongsTo(OfficiantService::class, 'officiant_service_id'); }
}
