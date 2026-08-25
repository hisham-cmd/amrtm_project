<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Any user with role='partner' who has a record in officiants table → role='officiant'
        DB::statement("
            UPDATE users
            INNER JOIN officiants ON officiants.user_id = users.id
            SET users.role = 'officiant'
            WHERE users.role = 'partner'
        ");
    }

    public function down(): void
    {
        DB::statement("
            UPDATE users
            INNER JOIN officiants ON officiants.user_id = users.id
            SET users.role = 'partner'
            WHERE users.role = 'officiant'
        ");
    }
};
