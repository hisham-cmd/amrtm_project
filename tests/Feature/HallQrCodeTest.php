<?php

namespace Tests\Feature;

use App\Enums\HallStatus;
use App\Models\Hall;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HallQrCodeTest extends TestCase
{
    use RefreshDatabase;

    public function test_active_hall_qr_code_returns_an_svg_image(): void
    {
        $hall = $this->createActiveHall();

        $response = $this->get(route('halls.qr', ['hall' => $hall]));

        $response->assertOk();
        $response->assertHeader('Content-Type', 'image/svg+xml');
        $response->assertSee('<svg', false);
    }

    public function test_hall_details_page_uses_the_generated_qr_endpoint(): void
    {
        $hall = $this->createActiveHall();

        $response = $this->get(route('halls.show', ['hall' => $hall]));

        $response->assertOk();
        $response->assertSee(route('halls.qr', ['hall' => $hall]), false);
        $response->assertSee(route('halls.show', ['hall' => $hall]), false);
    }

    private function createActiveHall(): Hall
    {
        $owner = User::factory()->create();

        return Hall::create([
            'owner_id' => $owner->id,
            'name' => 'قاعة الاختبار',
            'description' => 'قاعة مخصصة لاختبار رمز الاستجابة السريع.',
            'location' => 'الرياض',
            'city' => 'الرياض',
            'capacity' => 250,
            'max_tables' => 25,
            'price_per_day' => 5000,
            'status' => HallStatus::Active,
        ]);
    }
}