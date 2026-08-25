<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            // Venue public contact info (separate from rep's personal phone/email)
            $table->string('venue_phone', 20)->nullable()->after('phone');
            $table->string('venue_email', 150)->nullable()->after('venue_phone');
            $table->string('user_phone', 20)->nullable()->after('venue_email');

            // Officiant-specific fields
            $table->string('officiant_license_number', 60)->nullable()->after('user_phone');
            $table->string('officiant_working_hours', 100)->nullable()->after('officiant_license_number');
            $table->string('officiant_bank_account', 60)->nullable()->after('officiant_working_hours');
            $table->string('officiant_iban', 34)->nullable()->after('officiant_bank_account');
        });

        Schema::table('halls', function (Blueprint $table) {
            // Venue public contact info
            $table->string('venue_phone', 20)->nullable()->after('whatsapp_number');
            $table->string('venue_email', 150)->nullable()->after('venue_phone');
            $table->string('user_phone', 20)->nullable()->after('venue_email');
        });
    }

    public function down(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->dropColumn([
                'venue_phone', 'venue_email', 'user_phone',
                'officiant_license_number', 'officiant_working_hours',
                'officiant_bank_account', 'officiant_iban',
            ]);
        });

        Schema::table('halls', function (Blueprint $table) {
            $table->dropColumn(['venue_phone', 'venue_email', 'user_phone']);
        });
    }
};
