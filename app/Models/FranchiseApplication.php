<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FranchiseApplication extends Model
{
    protected $fillable = [
        'opportunity_id', 'brand_name', 'full_name', 'phone', 'email',
        'region', 'capital_range', 'has_experience', 'notes', 'status',
    ];

    protected $casts = [
        'has_experience' => 'boolean',
    ];

    public function opportunity()
    {
        return $this->belongsTo(FranchiseOpportunity::class);
    }

    public function statusLabel(): string
    {
        return match($this->status) {
            'pending'   => 'معلق',
            'reviewing' => 'قيد المراجعة',
            'approved'  => 'مقبول',
            'rejected'  => 'مرفوض',
            default     => $this->status,
        };
    }

    public function statusBadge(): string
    {
        return match($this->status) {
            'pending'   => 'badge-warning',
            'reviewing' => 'badge-info',
            'approved'  => 'badge-success',
            'rejected'  => 'badge-danger',
            default     => 'badge-secondary',
        };
    }
}
