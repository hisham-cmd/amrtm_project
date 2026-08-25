<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\AgentRefCode;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call(HallSeeder::class);

        // ── Test accounts ─────────────────────────────────────────────────────
        $accounts = [
            ['name' => 'مشرف النظام',      'email' => 'supervisor@test.com', 'phone' => '0500000001', 'role' => UserRole::Supervisor],
            ['name' => 'مدير المشروع',      'email' => 'manager@test.com',    'phone' => '0500000002', 'role' => UserRole::Manager],
            ['name' => 'مندوب تجريبي',      'email' => 'agent@test.com',      'phone' => '0500000003', 'role' => UserRole::Agent],
            ['name' => 'مالك قاعة تجريبي', 'email' => 'owner@test.com',      'phone' => '0500000004', 'role' => UserRole::Owner],
            ['name' => 'مستخدم تجريبي',    'email' => 'user@test.com',       'phone' => '0500000005', 'role' => UserRole::User],
        ];

        foreach ($accounts as $acc) {
            $user = User::firstOrCreate(
                ['email' => $acc['email']],
                [
                    'name'              => $acc['name'],
                    'phone'             => $acc['phone'],
                    'role'              => $acc['role'],
                    'password'          => Hash::make('password'),
                    'email_verified_at' => now(),
                ]
            );

            // Auto-generate ref code for agents
            if ($acc['role'] === UserRole::Agent && ! $user->refCode) {
                AgentRefCode::generateFor($user->id);
            }
        }
    }
}

