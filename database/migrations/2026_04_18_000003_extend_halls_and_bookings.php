<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1) Add rejected to halls.status enum (MySQL/MariaDB only — SQLite uses TEXT)
        if (in_array(DB::getDriverName(), ['mysql', 'mariadb'])) {
            DB::statement("ALTER TABLE halls MODIFY COLUMN status ENUM('pending','under_review','active','inactive','rejected') NOT NULL DEFAULT 'pending'");
        }

        // 2) Add registered_by (manager who brought the hall in) + commission_rate for that
        Schema::table('halls', function (Blueprint $table) {
            $table->foreignId('registered_by')->nullable()->after('owner_id')->constrained('users')->nullOnDelete();
            $table->decimal('registration_commission_rate', 5, 2)->default(0)->after('registered_by');
        });

        // 3) Add total_price to hall_bookings so we can track revenue historically
        Schema::table('hall_bookings', function (Blueprint $table) {
            $table->decimal('total_price', 10, 2)->default(0)->after('notes');
        });
    }

    public function down(): void
    {
        Schema::table('hall_bookings', function (Blueprint $table) {
            $table->dropColumn('total_price');
        });

        Schema::table('halls', function (Blueprint $table) {
            $table->dropForeign(['registered_by']);
            $table->dropColumn(['registered_by', 'registration_commission_rate']);
        });

        if (in_array(DB::getDriverName(), ['mysql', 'mariadb'])) {
            DB::statement("ALTER TABLE halls MODIFY COLUMN status ENUM('pending','under_review','active','inactive') NOT NULL DEFAULT 'pending'");
        }
    }
};
