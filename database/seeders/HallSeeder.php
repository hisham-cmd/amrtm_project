<?php

namespace Database\Seeders;

use App\Enums\HallStatus;
use App\Enums\UserRole;
use App\Models\Hall;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class HallSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(['email' => 'admin@amrtm.com.sa'], [
            'name'     => 'مدير النظام',
            'phone'    => '0500000001',
            'role'     => UserRole::Admin,
            'password' => Hash::make('Admin@1234'),
        ]);

        $owner = User::firstOrCreate(['email' => 'owner@amrtm.com.sa'], [
            'name'     => 'أحمد العمري',
            'phone'    => '0501234567',
            'role'     => UserRole::Owner,
            'password' => Hash::make('Owner@1234'),
        ]);

        User::firstOrCreate(['email' => 'user@amrtm.com.sa'], [
            'name'     => 'محمد الغامدي',
            'phone'    => '0559876543',
            'role'     => UserRole::User,
            'password' => Hash::make('User@1234'),
        ]);

        [$hall, $hallCreated] = [
            Hall::firstOrCreate(
                ['name' => 'قاعة لمسات', 'owner_id' => $owner->id],
                [
                    'description'     => 'قاعة فاخرة تتسع لأكبر المناسبات بتصميم عصري وخدمات متكاملة.',
                    'location'        => 'طريق الملك عبدالعزيز',
                    'city'            => 'الرياض',
                    'capacity'        => 200,
                    'max_tables'      => 50,
                    'price_per_day'   => 5000.00,
                    'whatsapp_number' => '0501234567',
                    'status'          => HallStatus::Active,
                ]
            ),
            null,
        ];
        $hallCreated = $hall->wasRecentlyCreated;

        if ($hallCreated) {
            $features = [
                ['name' => 'واي فاي مجاني',   'icon' => 'fa-wifi'],
                ['name' => 'موقف سيارات',      'icon' => 'fa-square-parking'],
                ['name' => 'تكييف مركزي',      'icon' => 'fa-wind'],
                ['name' => 'نظام صوت احترافي', 'icon' => 'fa-music'],
                ['name' => 'شاشات عرض',        'icon' => 'fa-tv'],
                ['name' => 'خدمة تصوير',       'icon' => 'fa-camera'],
            ];

            foreach ($features as $feature) {
                $hall->features()->create($feature);
            }

            $hall->seasonalPrices()->createMany([
                ['label' => 'موسم الأعراس (صيف)', 'start_date' => '2026-06-01', 'end_date' => '2026-08-31', 'price_per_day' => 7500.00],
                ['label' => 'إجازة نهاية العام',  'start_date' => '2026-12-20', 'end_date' => '2027-01-05', 'price_per_day' => 6500.00],
            ]);

            foreach (['2026-04-20', '2026-04-25', '2026-05-02', '2026-05-10'] as $date) {
                $hall->busyDates()->create(['busy_date' => $date, 'reason' => 'محجوز']);
            }
        }
    }
}