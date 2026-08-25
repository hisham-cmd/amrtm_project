<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HallOffer extends Model
{
    protected $fillable = [
        'hall_id', 'title', 'discount_type', 'discount_value',
        'description', 'included_services', 'start_date', 'end_date', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'start_date'        => 'date',
            'end_date'          => 'date',
            'included_services' => 'array',
            'is_active'         => 'boolean',
            'discount_value'    => 'decimal:2',
        ];
    }

    public function hall(): BelongsTo
    {
        return $this->belongsTo(Hall::class);
    }

    /** هل العرض نشط الآن؟ */
    public function isActiveNow(): bool
    {
        return $this->is_active
            && $this->start_date->lte(now())
            && $this->end_date->gte(now());
    }

    /** الخدمات المتاحة للاختيار */
    public static function availableServices(): array
    {
        return [
            'كوشة مجانية',
            'تصوير مجاني',
            'فيديو مجاني',
            'ضيافة مجانية',
            'ديجي مجاني',
            'زينة مجانية',
            'إضاءة مجانية',
            'باقة حلويات',
            'تنسيق طاولات',
            'مولد احتياطي',
        ];
    }
}
