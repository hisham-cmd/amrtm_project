<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hall_verification_documents', function (Blueprint $table) {
            $table->foreignId('hall_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('hall_verification_documents', function (Blueprint $table) {
            $table->foreignId('hall_id')->nullable(false)->change();
        });
    }
};
