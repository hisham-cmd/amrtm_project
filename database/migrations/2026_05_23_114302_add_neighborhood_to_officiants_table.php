<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('officiants', function (Blueprint $table) {
            $table->string('neighborhood', 100)->nullable()->after('city');
            $table->string('street', 150)->nullable()->after('neighborhood');
        });
    }

    public function down(): void
    {
        Schema::table('officiants', function (Blueprint $table) {
            $table->dropColumn(['neighborhood', 'street']);
        });
    }
};
