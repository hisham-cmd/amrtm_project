<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $driver = DB::getDriverName();
        if ($driver === 'mysql' || $driver === 'mariadb') {
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('user','owner','admin','supervisor','manager','agent') NOT NULL DEFAULT 'user'");
        }
        // SQLite stores TEXT and doesn't enforce ENUM at the DB level — no change needed
    }

    public function down(): void
    {
        $driver = DB::getDriverName();
        if ($driver === 'mysql' || $driver === 'mariadb') {
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('user','owner','admin') NOT NULL DEFAULT 'user'");
        }
    }
};
