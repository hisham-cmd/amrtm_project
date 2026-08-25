<?php

namespace App\Models;

use App\Enums\DocumentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HallVerificationDocument extends Model
{
    protected $fillable = [
        'hall_id', 'owner_id', 'document_type', 'file_path', 'expiry_date', 'status', 'admin_note',
    ];

    protected function casts(): array
    {
        return [
            'status' => DocumentStatus::class,
        ];
    }

    public function hall(): BelongsTo
    {
        return $this->belongsTo(Hall::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class, 'owner_id', 'user_id');
    }

    public function officiant(): BelongsTo
    {
        return $this->belongsTo(Officiant::class, 'owner_id', 'user_id');
    }
}
