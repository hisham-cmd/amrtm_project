<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class FranchiseOpportunity extends Model
{
    protected $fillable = [
        'name', 'name_en', 'logo', 'category', 'description', 'icon',
        'gradient_from', 'gradient_to', 'badge_text',
        'investment_min', 'investment_max',
        'roi_months_min', 'roi_months_max',
        'franchise_fee_percent',
        'available_regions', 'requirements',
        'status', 'is_featured', 'sort_order',
    ];

    protected $casts = [
        'available_regions' => 'array',
        'requirements'      => 'array',
        'is_featured'       => 'boolean',
    ];

    public static array $categories = [
        'food'     => 'مطاعم ومقاهي',
        'edu'      => 'تعليم وتدريب',
        'fitness'  => 'لياقة وصحة',
        'tech'     => 'تقنية',
        'home'     => 'خدمات منزلية',
        'services' => 'خدمات أعمال',
    ];

    public static array $regions = [
        'الرياض', 'جدة', 'مكة المكرمة', 'المدينة المنورة',
        'الدمام', 'الخبر', 'الأحساء', 'تبوك', 'أبها', 'جميع المناطق',
    ];

    public function steps(): HasMany
    {
        return $this->hasMany(FranchiseOpportunityStep::class, 'opportunity_id')->orderBy('sort_order');
    }

    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo ? Storage::disk('public')->url($this->logo) : null;
    }

    public function getCategoryLabelAttribute(): string
    {
        return self::$categories[$this->category] ?? $this->category;
    }

    public function scopeActive($q) { return $q->where('status', 'active')->orderBy('sort_order'); }
}
