<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('halls', function (Blueprint $table) {
            $table->string('street', 255)->nullable()->after('building_number');
            $table->string('floor', 20)->nullable()->after('street');
            $table->string('office_number', 20)->nullable()->after('floor');
        });

        Schema::table('partners', function (Blueprint $table) {
            $table->string('street', 255)->nullable()->after('building_number');
            $table->string('floor', 20)->nullable()->after('street');
            $table->string('office_number', 20)->nullable()->after('floor');
        });
    }

    public function down(): void
    {
        Schema::table('halls', function (Blueprint $table) {
            $table->dropColumn(['street', 'floor', 'office_number']);
        });

        Schema::table('partners', function (Blueprint $table) {
            $table->dropColumn(['street', 'floor', 'office_number']);
        });
    }
};
