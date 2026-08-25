<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CommercialAgency extends Model
{
    protected $fillable = [
        'name', 'name_en', 'logo', 'category', 'description', 'description_en',
        'country_origin', 'available_regions', 'agency_type',
        'investment_min', 'investment_max', 'min_years_experience',
        'requirements', 'benefits',
        'is_featured', 'is_verified', 'status', 'sort_order',
    ];

    protected $casts = [
        'available_regions' => 'array',
        'requirements'      => 'array',
        'benefits'          => 'array',
        'is_featured'       => 'boolean',
        'is_verified'       => 'boolean',
    ];

    public static array $categories = [
        'food'       => 'مطاعم ومواد غذائية',
        'tech'       => 'تقنية وبرمجيات',
        'retail'     => 'تجزئة وأزياء',
        'beauty'     => 'جمال وعناية',
        'industrial' => 'صناعة ومعدات',
        'services'   => 'خدمات أعمال',
        'medical'    => 'طبي وصحي',
        'auto'       => 'سيارات وقطع غيار',
    ];

    public static array $agencyTypes = [
        'exclusive_agent'    => 'وكيل حصري',
        'distributor'        => 'موزع رئيسي',
        'strategic_partner'  => 'شريك استراتيجي',
        'reseller'           => 'إعادة بيع معتمد',
        'certified_dealer'   => 'وكيل معتمد',
    ];

    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo ? Storage::disk('public')->url($this->logo) : null;
    }

    public function getAgencyTypeLabelAttribute(): string
    {
        return self::$agencyTypes[$this->agency_type] ?? $this->agency_type;
    }

    public function getCategoryLabelAttribute(): string
    {
        return self::$categories[$this->category] ?? $this->category;
    }

    public function scopeActive($q) { return $q->where('status', 'active')->orderByDesc('is_featured')->orderBy('sort_order'); }
}
