<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PartnerService extends Model
{
    protected $fillable = ['partner_id', 'title', 'description', 'price', 'sort_order'];

    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }
}
