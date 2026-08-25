<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class FranchiseBrand extends Model
{
    protected $table = 'franchise_brands';

    protected $fillable = [
        'name', 'name_en', 'logo', 'category', 'subcategory',
        'description', 'description_en',
        'investment_min', 'investment_max',
        'roi_months_min', 'roi_months_max',
        'franchise_fee_percent',
        'available_regions', 'requirements', 'features',
        'is_featured', 'is_auction_eligible',
        'status', 'sort_order',
    ];

    protected $casts = [
        'available_regions'   => 'array',
        'requirements'        => 'array',
        'features'            => 'array',
        'is_featured'         => 'boolean',
        'is_auction_eligible' => 'boolean',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(FranchiseBrandImage::class, 'brand_id')->orderBy('sort_order');
    }

    public function auctions(): HasMany
    {
        return $this->hasMany(FranchiseAuction::class, 'brand_id');
    }

    public function activeAuction()
    {
        return $this->auctions()
            ->where('status', 'active')
            ->where('ends_at', '>', now())
            ->latest()
            ->first();
    }

    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo ? Storage::disk('public')->url($this->logo) : null;
    }

    public function getInvestmentRangeAttribute(): string
    {
        return number_format($this->investment_min) . ' — ' . number_format($this->investment_max) . ' ر.س';
    }

    public static function investmentRanges(): array
    {
        return [
            ['label' => 'أقل من 100,000 ريال',                  'min' => 0,        'max' => 99999],
            ['label' => 'من 100,000 إلى 300,000 ريال',          'min' => 100000,   'max' => 299999],
            ['label' => 'من 300,000 إلى 750,000 ريال',          'min' => 300000,   'max' => 749999],
            ['label' => 'من 750,000 إلى 2,000,000 ريال',        'min' => 750000,   'max' => 1999999],
            ['label' => 'أكثر من 2,000,000 ريال',               'min' => 2000000,  'max' => PHP_INT_MAX],
        ];
    }
}
