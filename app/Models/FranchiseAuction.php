<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FranchiseAuction extends Model
{
    protected $table = 'franchise_auctions';

    protected $fillable = [
        'brand_id', 'title', 'description',
        'starting_bid', 'current_bid', 'reserve_price',
        'increment_amount', 'deposit_amount', 'bids_count',
        'status', 'starts_at', 'ends_at', 'winner_id',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at'   => 'datetime',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(FranchiseBrand::class, 'brand_id');
    }

    public function bids(): HasMany
    {
        return $this->hasMany(FranchiseBid::class, 'auction_id')->latest();
    }

    public function winner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'winner_id');
    }

    public function isActive(): bool
    {
        return $this->status === 'active' && $this->ends_at->isFuture();
    }

    public function minNextBid(): int
    {
        return $this->current_bid + $this->increment_amount;
    }

    public function getSecondsRemainingAttribute(): int
    {
        return max(0, now()->diffInSeconds($this->ends_at, false));
    }
}
