<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Unify supervisor_partners into partners table.
 *
 * After this migration:
 *  - partners.type = 'simple'  → manually added by a supervisor/manager, no login account
 *  - partners.type = 'account' → full partner account with user login
 *  - partners.user_id          → nullable (null for simple partners)
 *  - partners.added_by         → FK to users (supervisor/manager who added the simple partner)
 */
return new class extends Migration
{
    public function up(): void
    {
        // 1. Alter partners table ────────────────────────────────────────────

        // Make user_id nullable (MySQL/MariaDB only — SQLite uses TEXT and is always nullable)
        if (in_array(DB::getDriverName(), ['mysql', 'mariadb'])) {
            DB::statement('ALTER TABLE partners MODIFY COLUMN user_id BIGINT UNSIGNED NULL');
        }

        Schema::table('partners', function (Blueprint $table) {
            // Who added this partner (supervisor / manager)
            $table->unsignedBigInteger('added_by')->nullable()->after('user_id');
            $table->foreign('added_by')->references('id')->on('users')->nullOnDelete();

            // Distinguish manually-added vs full-account partners
            $table->enum('type', ['simple', 'account', 'officiant'])->default('account')->after('added_by');
        });

        // 2. Migrate existing supervisor_partners rows ───────────────────────
        if (Schema::hasTable('supervisor_partners')) {
            DB::statement("
                INSERT INTO partners
                    (user_id, added_by, type, category_id, company_name, description,
                     phone, whatsapp, logo_path, status, created_at, updated_at)
                SELECT
                    NULL,
                    supervisor_id,
                    'simple',
                    category_id,
                    company_name,
                    description,
                    phone,
                    whatsapp,
                    logo_path,
                    'active',
                    created_at,
                    updated_at
                FROM supervisor_partners
            ");

            // 3. Drop the old table ──────────────────────────────────────────
            Schema::dropIfExists('supervisor_partners');
        }
    }

    public function down(): void
    {
        // 1. Recreate supervisor_partners ────────────────────────────────────
        Schema::create('supervisor_partners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supervisor_id');
            $table->unsignedBigInteger('category_id');
            $table->string('company_name', 150);
            $table->string('description', 255)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('whatsapp', 20)->nullable();
            $table->string('price', 100)->nullable();
            $table->text('offers')->nullable();
            $table->string('logo_path')->nullable();
            $table->timestamps();

            $table->foreign('supervisor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('partner_categories')->onDelete('cascade');
        });

        // 2. Move simple partners back ────────────────────────────────────────
        DB::statement("
            INSERT INTO supervisor_partners
                (supervisor_id, category_id, company_name, description,
                 phone, whatsapp, logo_path, created_at, updated_at)
            SELECT
                COALESCE(added_by, 1),
                category_id,
                company_name,
                description,
                phone,
                whatsapp,
                logo_path,
                created_at,
                updated_at
            FROM partners
            WHERE type = 'simple'
        ");

        // 3. Remove simple partners from partners table ───────────────────────
        DB::table('partners')->where('type', 'simple')->delete();

        // 4. Restore partners table structure ────────────────────────────────
        Schema::table('partners', function (Blueprint $table) {
            $table->dropForeign(['added_by']);
            $table->dropColumn(['added_by', 'type']);
        });

        if (in_array(DB::getDriverName(), ['mysql', 'mariadb'])) {
            DB::statement('ALTER TABLE partners MODIFY COLUMN user_id BIGINT UNSIGNED NOT NULL');
        }
    }
};
