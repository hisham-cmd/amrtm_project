<?php

namespace App\Models;

use App\Enums\HallStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hall extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id', 'registered_by', 'registration_commission_rate',
        'name', 'entity_type', 'venue_type', 'description',
        'location', 'building_number', 'street', 'floor', 'office_number', 'city', 'country',
        'commercial_reg_number', 'unified_number',
        'latitude', 'longitude',
        'capacity', 'max_tables', 'price_per_day',
        'profile_photo', 'cover_photo', 'whatsapp_number', 'venue_phone', 'venue_email', 'user_phone', 'status', 'admin_note',
        // Manager
        'manager_first_name', 'manager_father_name', 'manager_grandfather_name', 'manager_phone',
        // System representative
        'rep_first_name', 'rep_father_name', 'rep_grandfather_name',
    ];

    protected function casts(): array
    {
        return [
            'status'        => HallStatus::class,
            'price_per_day' => 'decimal:2',
        ];
    }

    // ── Relationships ─────────────────────────────────────────────────────

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function registeredBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'registered_by');
    }

    public function media(): HasMany
    {
        return $this->hasMany(HallMedia::class)->orderBy('sort_order');
    }

    public function features(): HasMany
    {
        return $this->hasMany(HallFeature::class);
    }

    public function partners(): HasMany
    {
        return $this->hasMany(HallPartner::class);
    }

    public function seasonalPrices(): HasMany
    {
        return $this->hasMany(HallSeasonalPrice::class);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(HallOffer::class);
    }

    public function busyDates(): HasMany
    {
        return $this->hasMany(HallBusyDate::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(HallBooking::class);
    }

    public function verificationDocuments(): HasMany
    {
        return $this->hasMany(HallVerificationDocument::class);
    }

    public function additionalFeatures(): HasMany
    {
        return $this->hasMany(AdditionalFeature::class);
    }

    // ── Business logic ────────────────────────────────────────────────────

    public function isBusyOn(string $date): bool
    {
        return $this->busyDates()->where('busy_date', $date)->exists();
    }

    public function getPriceFor(string $date): float
    {
        $seasonal = $this->seasonalPrices()
            ->where('start_date', '<=', $date)
            ->where('end_date', '>=', $date)
            ->first();

        return $seasonal ? (float) $seasonal->price_per_day : (float) $this->price_per_day;
    }
}
