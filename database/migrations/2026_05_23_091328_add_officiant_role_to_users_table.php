<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin','supervisor','manager','agent','owner','partner','officiant','user') NOT NULL DEFAULT 'user'");
    }

    public function down(): void
    {
        DB::statement("UPDATE users SET role = 'partner' WHERE role = 'officiant'");
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin','supervisor','manager','agent','owner','partner','user') NOT NULL DEFAULT 'user'");
    }
};
