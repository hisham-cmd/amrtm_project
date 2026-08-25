<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('users')
            ->where('role', 'admin')
            ->update(['role' => 'supervisor']);
    }

    public function down(): void
    {
        // Intentionally irreversible — cannot know which supervisors were originally admin
    }
};
