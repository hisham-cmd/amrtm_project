<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OfficiantMedia extends Model
{
    protected $fillable = ['officiant_id', 'file_path', 'sort_order'];

    public function officiant(): BelongsTo
    {
        return $this->belongsTo(Officiant::class);
    }
}
