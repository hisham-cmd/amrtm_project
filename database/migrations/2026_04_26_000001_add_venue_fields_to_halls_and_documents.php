<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('halls', function (Blueprint $table) {
            $table->string('venue_type')->nullable()->after('name'); // wedding_hall | retreat | chalet
            $table->decimal('latitude',  10, 7)->nullable()->after('city');
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
        });

        Schema::table('hall_verification_documents', function (Blueprint $table) {
            $table->date('expiry_date')->nullable()->after('file_path');
        });
    }

    public function down(): void
    {
        Schema::table('halls', function (Blueprint $table) {
            $table->dropColumn(['venue_type', 'latitude', 'longitude']);
        });

        Schema::table('hall_verification_documents', function (Blueprint $table) {
            $table->dropColumn('expiry_date');
        });
    }
};
