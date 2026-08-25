<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Any dev/test rows with type='officiant' move to 'account' before shrinking the enum.
        DB::table('partners')->where('type', 'officiant')->update(['type' => 'account']);

        // Officiants now live in the dedicated `officiants` table.
        DB::statement("ALTER TABLE partners MODIFY COLUMN type ENUM('simple','account') NOT NULL DEFAULT 'account'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE partners MODIFY COLUMN type ENUM('simple','account','officiant') NOT NULL DEFAULT 'account'");
    }
};
