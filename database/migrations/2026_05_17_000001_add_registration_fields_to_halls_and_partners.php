<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ── halls ─────────────────────────────────────────────────────────
        Schema::table('halls', function (Blueprint $table) {
            $table->enum('entity_type', ['individual', 'institution', 'company'])->nullable()->after('venue_type');
            $table->string('building_number', 20)->nullable()->after('location');
            $table->string('unified_number', 60)->nullable()->after('commercial_reg_number');

            // Manager info
            $table->string('manager_first_name', 60)->nullable()->after('unified_number');
            $table->string('manager_father_name', 60)->nullable()->after('manager_first_name');
            $table->string('manager_grandfather_name', 60)->nullable()->after('manager_father_name');
            $table->string('manager_phone', 20)->nullable()->after('manager_grandfather_name');

            // System representative info
            $table->string('rep_first_name', 60)->nullable()->after('manager_phone');
            $table->string('rep_father_name', 60)->nullable()->after('rep_first_name');
            $table->string('rep_grandfather_name', 60)->nullable()->after('rep_father_name');
        });

        // ── partners ──────────────────────────────────────────────────────
        Schema::table('partners', function (Blueprint $table) {
            $table->enum('entity_type', ['individual', 'institution', 'company'])->nullable()->after('type');
            $table->string('building_number', 20)->nullable()->after('address');
            $table->string('unified_number', 60)->nullable()->after('commercial_reg_number');

            // Manager info
            $table->string('manager_first_name', 60)->nullable()->after('unified_number');
            $table->string('manager_father_name', 60)->nullable()->after('manager_first_name');
            $table->string('manager_grandfather_name', 60)->nullable()->after('manager_father_name');
            $table->string('manager_phone', 20)->nullable()->after('manager_grandfather_name');

            // System representative info
            $table->string('rep_first_name', 60)->nullable()->after('manager_phone');
            $table->string('rep_father_name', 60)->nullable()->after('rep_first_name');
            $table->string('rep_grandfather_name', 60)->nullable()->after('rep_father_name');
        });

        // ── users ─────────────────────────────────────────────────────────
        Schema::table('users', function (Blueprint $table) {
            $table->string('father_name', 60)->nullable()->after('name');
            $table->string('grandfather_name', 60)->nullable()->after('father_name');
        });
    }

    public function down(): void
    {
        Schema::table('halls', function (Blueprint $table) {
            $table->dropColumn([
                'entity_type', 'building_number', 'unified_number',
                'manager_first_name', 'manager_father_name', 'manager_grandfather_name', 'manager_phone',
                'rep_first_name', 'rep_father_name', 'rep_grandfather_name',
            ]);
        });

        Schema::table('partners', function (Blueprint $table) {
            $table->dropColumn([
                'entity_type', 'building_number', 'unified_number',
                'manager_first_name', 'manager_father_name', 'manager_grandfather_name', 'manager_phone',
                'rep_first_name', 'rep_father_name', 'rep_grandfather_name',
            ]);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['father_name', 'grandfather_name']);
        });
    }
};
