<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() !== 'sqlite') {
            return;
        }

        DB::statement('PRAGMA foreign_keys = OFF');

        DB::statement('
            CREATE TABLE users_new (
                "id" integer primary key autoincrement not null,
                "name" varchar not null,
                "email" varchar not null,
                "phone" varchar,
                "role" varchar check ("role" in (\'user\',\'owner\',\'admin\',\'supervisor\',\'manager\',\'agent\',\'partner\')) not null default \'user\',
                "email_verified_at" datetime,
                "password" varchar not null,
                "remember_token" varchar,
                "created_at" datetime,
                "updated_at" datetime
            )
        ');

        DB::statement('INSERT INTO users_new SELECT * FROM users');
        DB::statement('DROP TABLE users');
        DB::statement('ALTER TABLE users_new RENAME TO users');
        DB::statement('CREATE UNIQUE INDEX "users_email_unique" ON "users" ("email")');

        DB::statement('PRAGMA foreign_keys = ON');
    }

    public function down(): void
    {
        // irreversible
    }
};
