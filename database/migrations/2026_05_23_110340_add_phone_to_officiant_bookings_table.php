<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('officiant_bookings', function (Blueprint $table) {
            $table->string('phone', 20)->nullable()->after('event_date');
        });
    }

    public function down(): void
    {
        Schema::table('officiant_bookings', function (Blueprint $table) {
            $table->dropColumn('phone');
        });
    }
};
