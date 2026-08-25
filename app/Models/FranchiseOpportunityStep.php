<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FranchiseOpportunityStep extends Model
{
    protected $fillable = ['opportunity_id', 'title', 'description', 'icon', 'sort_order'];

    public function opportunity(): BelongsTo
    {
        return $this->belongsTo(FranchiseOpportunity::class);
    }
}
