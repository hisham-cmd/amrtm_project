<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('business')->table('bs_offices', function (Blueprint $table) {
            $table->string('office_code', 20)->nullable()->unique()->after('id');
            $table->string('public_token', 64)->nullable()->unique()->after('office_code');
        });
    }

    public function down(): void
    {
        Schema::connection('business')->table('bs_offices', function (Blueprint $table) {
            $table->dropUnique(['office_code']);
            $table->dropUnique(['public_token']);
            $table->dropColumn(['office_code', 'public_token']);
        });
    }
};