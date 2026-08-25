<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('halls', function (Blueprint $table) {
            $table->string('country', 100)->nullable()->after('city');
            $table->string('commercial_reg_number', 60)->nullable()->after('country');
        });

        Schema::table('partners', function (Blueprint $table) {
            $table->string('country', 100)->nullable()->after('city');
            $table->string('commercial_reg_number', 60)->nullable()->after('country');
        });
    }

    public function down(): void
    {
        Schema::table('halls', function (Blueprint $table) {
            $table->dropColumn(['country', 'commercial_reg_number']);
        });

        Schema::table('partners', function (Blueprint $table) {
            $table->dropColumn(['country', 'commercial_reg_number']);
        });
    }
};
