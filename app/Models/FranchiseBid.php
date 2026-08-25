<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FranchiseBid extends Model
{
    protected $table = 'franchise_bids';

    protected $fillable = ['auction_id', 'user_id', 'amount', 'status', 'deposit_ref'];

    public function auction(): BelongsTo
    {
        return $this->belongsTo(FranchiseAuction::class, 'auction_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
